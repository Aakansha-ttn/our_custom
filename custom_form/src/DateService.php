<?php

namespace Drupal\custom_form;



class DateService {

  
    public function datef($date) { 
      if ($date != NULL) {

        return date('jS F Y',strtotime($date));
     
      }
      else {
        return NULL;
      }
     
  }

}
