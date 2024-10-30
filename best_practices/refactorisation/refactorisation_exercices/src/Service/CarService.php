<?php

namespace App\Service;

use App\Repository\CarRepository;
use App\Entity\Car;

class CarService{

    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function sellCar($brand, $model, $isManual = true, $engine, $doorNumber, $category, $dateOfBuild, $date, $price, $buyerName, $buyerAddress, $buyerPhone, $buyerEmail){

        $car = new Car();
        $car->setBrand($brand);
        $car->setModel($model);

        if($isManual == true){
            $car->setGearbox('manual');
        }else{
            $car->setGearbox('automatic');
        }

        $car->setEngine($engine);
        $car->setDoorNumber($doorNumber);
        $car->setCategory($category);

        $message = 'This ';

        if($dateOfBuild < '1993-01-01'){
            $message .= 'old ';
        }

        $message .= 'car is a ' . $car->getBrand() . ' ' . $car->getModel() . ' with a ' . $car->getEngine() . ' engine. It has ' . $car->getDoorNumber() . ' doors and a ' . $car->getGearbox() . ' gearbox. It is a ' . $car->getCategory() . ' car.';
        $message .= ' It was built in ' . $dateOfBuild->format('Y') . ' and sold in ' . $date->format('Y') . ' for ' . $price . '€. The buyer is ' . $buyerName . ' who lives at ' . $buyerAddress . '. You can contact him at ' . $buyerPhone . ' or ' . $buyerEmail . '.';
        return $message;
    }
}