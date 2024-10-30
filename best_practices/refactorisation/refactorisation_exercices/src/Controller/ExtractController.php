<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExtractController extends AbstractController
{
    #[Route('/exercices/rename/1', name: 'exercices_rename_1', methods: ['GET'])]
    public function checkPlantsAreCompatible(): Response
    {
        $plantLeft = [
            'name' => 'Tomato',
            'soil' => 'clay',
            'exposure' => 'south',
            'hardiness' => '0',
            'fertilizer' => 'every week',
            'water' => 'every day',
            'maxSoilPh' => '7',
            'minSoilPh' => '6',
            'maxSoilMoisture' => '100',
            'minSoilMoisture' => '80',
        ];

        $plantRight = [
            'name' => 'Rose',
            'soil' => 'clay',
            'exposure' => 'south',
            'hardiness' => '0',
            'fertilizer' => 'every week',
            'water' => 'every week',
            'maxSoilPh' => '7',
            'minSoilPh' => '6',
            'maxSoilMoisture' => '75',
            'minSoilMoisture' => '55',
        ];

        $isSoilCompatible = $plantLeft['soil'] == $plantRight['soil'];
        $isExposureCompatible = $plantLeft['exposure'] == $plantRight['exposure'];
        $isFertilizerCompatible = $plantLeft['fertilizer'] == $plantRight['fertilizer'];
        $isWaterCompatible = $plantLeft['water'] == $plantRight['water'];
        $isSoilPhCompatible = $plantLeft['maxSoilPh'] >= $plantRight['minSoilPh'] && $plantLeft['minSoilPh'] <= $plantRight['maxSoilPh'];
        $isSoilMoistureCompatible = $plantLeft['maxSoilMoisture'] >= $plantRight['minSoilMoisture'] && $plantLeft['minSoilMoisture'] <= $plantRight['maxSoilMoisture'];

        $isCompatible = [
            'isSoilCompatible' => $isSoilCompatible,
            'isExposureCompatible' => $isExposureCompatible,
            'isFertilizerCompatible' => $isFertilizerCompatible,
            'isWaterCompatible' => $isWaterCompatible,
            'isSoilPhCompatible' => $isSoilPhCompatible,
            'isSoilMoistureCompatible' => $isSoilMoistureCompatible,
        ];

        $status = 200;
        foreach($isCompatible as $key => $value) {
            $message = '';

            if (!$value) {
                $status = 400;

                switch($key) {
                    case 'isSoilCompatible':
                        $reason = 'soil';
                        break;
                    case 'isExposureCompatible':
                        $reason = 'exposure';
                        break;
                    case 'isFertilizerCompatible':
                        $reason = 'fertilizer';
                        break;
                    case 'isWaterCompatible':
                        $reason = 'water';
                        break;
                    case 'isSoilPhCompatible':
                        $reason = 'soil ph';
                        break;
                    case 'isSoilMoistureCompatible':
                        $reason = 'soil moisture';
                        break;
                }

                if(empty($message)) {
                    $message = 'The plants are not compatible because of ' . $reason;
                } else {
                    $message .= ', ' . $key;
                }
            }
        }

        if ($status === 200) {
            $message = 'The plants are compatible';
        }

        return new JsonResponse($message, $status);
    }
}
