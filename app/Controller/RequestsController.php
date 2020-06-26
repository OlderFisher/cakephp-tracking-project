<?php

App::uses('AuthComponent', 'Controller/Component');

class RequestsController extends AppController {
	public $helpers = array('Html', 'Form', 'Js');
	public $components = array('Email', 'Session', 'Cookie', 'RequestHandler', 'Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function formRequest() {
		$title_for_layout = __('meta.title.request.form');
		$this->set('title_for_layout',  $title_for_layout.' - '.Configure::read('Site.name'));

		$this->loadModel('ReqCategorie');
		$this->ReqCategorie->recursive = -1;
		$categories = $this->ReqCategorie->find('list',array(
			'conditions' => array(
				'ReqCategorie.id' => array(10, 11)
			),
			'fields' => array('id', 'name_en'),
			'order' => 'name ASC'
		));
		$this->set('categories', $categories);

		$user = $this->Auth->user();

		if ($this->request->is('post')) {

			$this->request->data['ReqTicket']['customer_id'] = $user['id'];
			$this->request->data['ReqTicket']['status_id'] = 1;

			$this->loadModel('ReqTicket');
			if ($this->ReqTicket->save($this->request->data)) {
				$this->Session->setFlash(__('message.error.request.assistance'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('controller' => 'requests', 'action' => 'listRequest', 'language' => $this->Session->read('Config.language')));
			} else {
				$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'requests', 'action' => 'formRequest', 'language' => $this->Session->read('Config.language')));
			}
		}
	}

	public function listRequest() {
		$title_for_layout = __('meta.title.list.form');
		$this->set('title_for_layout',  $title_for_layout.' - '.Configure::read('Site.name'));

		$this->loadModel('ReqCategorie');
		$this->ReqCategorie->recursive = -1;
		$categories = $this->ReqCategorie->find('list',array(
			'conditions' => array(
				'ReqCategorie.id' => array(10, 11)
			),
			'fields' => array('id', 'name_en'),
			'order' => 'name ASC'
		));
		$this->set('categories', $categories);

		$user = $this->Auth->user();

		$this->loadModel('ReqTicket');
		$allTickets = $this->ReqTicket->find('all', array(
			'conditions' => array(
				'ReqTicket.customer_id' => $user['id'],
			),
			'fields' => array('ReqTicket.id', 'ReqTicket.subject', 'ReqTicket.created', 'ReqStatus.id', 'ReqCategorie.id'),
			'order' => array('ReqTicket.id' => 'DESC')
		));
		$this->set('allTickets', $allTickets);
	}

	public function detailRequest($id = null) {
		$title_for_layout = __('meta.title.request.detail');
		$this->set('title_for_layout',  $title_for_layout.' - '.Configure::read('Site.name'));

		$user = $this->Auth->user();

		$this->loadModel('ReqTicket');
		$ticket = $this->ReqTicket->find('first', array(
			'conditions' => array(
				'ReqTicket.customer_id' => $user['id'],
				'ReqTicket.id' => $id,
			),
			'fields' => array('ReqTicket.id', 'ReqTicket.subject', 'ReqTicket.content', 'ReqTicket.created', 'ReqStatus.id', 'ReqTicket.user_id', 'ReqTicket.status_id'),
		));
		$this->set('ticket', $ticket);

		if (empty($ticket) || empty($id)) {
			$this->Session->setFlash(__('message.error.request.ticket_not_exist'), 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'requests', 'action' => 'listRequest', 'language' => $this->Session->read('Config.language')));
		}

		$this->loadModel('ReqMessage');
		$allMessages = $this->ReqMessage->find('all', array(
			'conditions' => array(
				'ReqMessage.customer_id' => $user['id'],
				'ReqMessage.ticket_id' => $id,
			),
			'order' => array('ReqMessage.created' => 'DESC')
		));
		$this->set('allMessages', $allMessages);

		if ($this->request->is('post')) {

			if ($ticket['ReqTicket']['status_id'] == 4) {
				$this->Session->setFlash(__('message.error.request.ticket_already_closed'), 'default', array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'requests', 'action' => 'listRequest', 'language' => $this->Session->read('Config.language')));
			}

			$this->request->data['ReqTicket']['id'] = $ticket['ReqTicket']['id'];
			$this->request->data['ReqMessage']['ticket_id'] = $ticket['ReqTicket']['id'];
			$this->request->data['ReqMessage']['customer_id'] = $user['id'];
			$this->request->data['ReqMessage']['user_id'] = $ticket['ReqTicket']['user_id'];
			$this->request->data['ReqMessage']['send'] = "customer";
			$this->request->data['ReqTicket']['status_id'] = 3;

			if ($this->ReqMessage->saveAll($this->request->data)) {
				$this->Session->setFlash(__('message.success.request.send'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('controller' => 'requests', 'action' => 'detailRequest', 'language' => $this->Session->read('Config.language'), $id));
			} else {
				$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'requests', 'action' => 'listRequest', 'language' => $this->Session->read('Config.language')));
			}
		}

	}

	public function closeTicket($id = null) {
		$user = $this->Auth->user();

		$this->loadModel('ReqTicket');
		$this->ReqTicket->recursive = -1;
		$ticket = $this->ReqTicket->find('first', array(
			'conditions' => array(
				'ReqTicket.customer_id' => $user['id'],
				'ReqTicket.id' => $id,
			)
		));
		$this->set('ticket', $ticket);

		if (empty($ticket) || empty($id)) {
			$this->Session->setFlash(__('message.error.request.ticket_not_exist'), 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'requests', 'action' => 'listRequest', 'language' => $this->Session->read('Config.language')));
		}

		if ($ticket['ReqTicket']['status_id'] == 4) {
			$this->Session->setFlash(__('message.error.request.ticket_already_closed'), 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'requests', 'action' => 'listRequest', 'language' => $this->Session->read('Config.language')));
		}

		$this->request->data['ReqTicket']['id'] = $ticket['ReqTicket']['id'];
		$this->request->data['ReqTicket']['status_id'] = 4;

		if ($this->ReqTicket->saveAll($this->request->data)) {
			$this->Session->setFlash(__('message.success.request.ticket_closed'), 'default', array('class' => 'alert alert-success'));
			$this->redirect(array('controller' => 'requests', 'action' => 'detailRequest', 'language' => $this->Session->read('Config.language'), $id));
		} else {
			$this->Session->setFlash(__('message.error.unknown'), 'default', array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'requests', 'action' => 'listRequest', 'language' => $this->Session->read('Config.language')));
		}

	}

}
