<?php

namespace Src\Model;

class Reparation {

    private $reparationID;
    private $workshopID;
    private $workshopName;
    private $registerDate;
    private $licensePlate;

    public function __construct($reparationID, $workshopID, $workshopName, $registerDate, $licensePlate) {
        $this->reparationID = $reparationID;
        $this->workshopID = $workshopID;
        $this->workshopName = $workshopName;
        $this->registerDate = $registerDate;
        $this->licensePlate = $licensePlate;
    }

    /**
     * Get the value of reparationID
     */ 
    public function getReparationID()
    {
        return $this->reparationID;
    }

    /**
     * Get the value of workshopID
     */ 
    public function getWorkshopID()
    {
        return $this->workshopID;
    }

    /**
     * Get the value of workshopName
     */ 
    public function getWorkshopName()
    {
        return $this->workshopName;
    }

    /**
     * Get the value of registerDate
     */ 
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Get the value of licensePlate
     */ 
    public function getLicensePlate()
    {
        return $this->licensePlate;
    }
}