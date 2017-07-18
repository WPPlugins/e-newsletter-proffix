<?php
class controllerENewsletter {

    private $data = array();
    public $success_message = '';

    public $errors = array();


    public function insert($data = array())
    {
        $this->set_sanitized_data($data);

        if($this->validate() === false)
        {
            return false;
        }

        if($this->send() === false)
        {
            return false;
        }

        return false;
    }


    private function set_sanitized_data($data)
    {
        foreach($data as $key => $value)
        {
            switch($key)
            {
                default:
                    $this->data[$key] = sanitize_text_field($value);
                    break;

                case "email":
                    $this->data[$key] = sanitize_email($value);
                    break;

            }
        }
        return true;
    }



    private function validate()
    {

        if(isset($this->data['name']) && empty($this->data['name']))
        {
            $this->errors['name'] = 'Name darf nicht leer sein';
        }

        if(!is_email($this->data["email"]) || empty($this->data["email"]))
        {
            $this->errors['email'] = 'Email darf nicht leer sein';
        }

        if(!empty($this->errors))
        {
            return false;
        }

        return true;
    }

    private function send()
    {

        //Decode specific values from info
        $conf = explode(",",base64_decode($this->data['info']));

        //URL for E-Newsletter Service.
        $url = $conf[0].'/pxNewsletter.asmx/R?value=D!'.$conf[1].'¿T!ANMELDUNG¿E!'.$this->data['email'].'¿UN!'.urlencode($this->data['name']).'¿NLT!'.$conf[2];

        //Initiate cURL
        $ch = curl_init();

        //Setup some of our options.
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Execute the cURL request.
        $result = curl_exec($ch);

        //Get the resulting HTTP status code from the cURL handle.
        $http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //Close cURL handle
        curl_close($ch);

        //Check if Subscription is successful
        if( $http_status_code != 200){
            $this->errors['email'] = get_option("proffix_newsletter_settings_error");
        }
        return true;
    }

}
?>