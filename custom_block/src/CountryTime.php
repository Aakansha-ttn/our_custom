<?php
namespace Drupal\custom_block;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Component\Datetime\TimeInterface;


class CountryTime{

    protected $configFactory;
    protected $time;
    
    public function __construct(ConfigFactoryInterface $config_factory, TimeInterface $time){
        $this->configFactory= $config_factory;
        $this->time= $time;
    }

    public function countryName(){
        $config= $this->configFactory->get('system.date');
        return $config->get('country.default');
    }

    public function timeZone(){
        return date('d-m-Y h:i:s a',$this->time->getCurrentTime());
    }
}