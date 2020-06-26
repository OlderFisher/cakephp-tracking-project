  <?php
  App::import('Component', 'Auth');
class SiteAuthComponent extends AuthComponent {

    function identify($user = null, $conditions = null) {
        $models = array('Customer', 'PoundCustomer');
        foreach ($models as $model) {
            $this->userModel = $model; // switch model
            $this->params["data"][$model] = $this->params["data"]["User"]; // switch model in params/data too
            $result = parent::identify($this->params["data"][$model], $conditions); // let cake do its thing
            if ($result) {
                return $result; // login success
            }
        }
        return null; // login failure
    }
}