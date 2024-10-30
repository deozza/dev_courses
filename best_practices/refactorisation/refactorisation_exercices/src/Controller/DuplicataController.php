<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DuplicataController extends AbstractController
{
    #[Route('/exercices/duplicata/1', name: 'exercices_duplicata_1', methods: ['POST'])]
    public function sendMessage(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        
        $template = $this->getTemplateById($data['templateId']);

        if($data['messageType'] === 'sms'){
            $to = $data['to'];
            $body = sprintf($template, $data['to'], $data['from'], $data['body']);
            $from = $data['from'];

            $message = [
                'to' => $to,
                'body' => $body,
                'from' => $from
            ];

            return new JsonResponse([
                'message' => $message
            ], 201);
        }

        if($data['messageType'] === 'email'){

            $provider = 'textMailSender';

            if(strpos($template, '<html>') !== false && strpos($template, '</html>') !== false){
                $provider = 'htmlMailSender';
            }
    
            if(isset($data, 'forcesProvider')){
                $provider = $data['forcesProvider'];
            }

            if($provider === 'textMailSender'){
                if(is_string($data['to'])){
                    $to = explode(',', $data['to']);
                }else{
                    $to = $data['to'];
                }

                if($data['env'] === 'test'){
                    $to = 'test@gmail.com';
                }
    
            }

            if($provider === 'htmlMailSender'){                
                $to = $data['to'];

                if($data['env'] === 'test'){
                    $to = 'test@gmail.com';
                }
            }
            
            $body = sprintf($template, $data['to'], $data['from'], $data['body']);

            $message = [
                'to' => $data['to'],
                'from' => $data['from'],
                'subject' => $data['subject'],
                'body' => $body
            ];

            if(isset($data['attachment'])){
                $fileExists = file_exists($data['attachment']);

                if(!$fileExists){
                    return new JsonResponse([
                        'message' => 'File not found'
                    ], 404);
                }

                $attachment = file_get_contents($data['attachment']);

                if($provider === 'textMailSender'){
                    $body .= 'Vous trouverez en pièce jointe le fichier';
                    $message['attachment'] = $attachment;
                    
                }

                if($provider === 'htmlMailSender'){
                    $encodedAttachment = base64_encode($attachment);
                    $body .= '<p>Vous trouverez en pièce jointe le fichier</p>';
                    $message['attachment'] = $encodedAttachment;
                }
            }    
        }

        return new JsonResponse([
           'message' => $message
        ], 201);

    }

    private function getTemplateById(int $id): string
    {
        $textTemplate = 'Bonjour %s, vous avez reçu un message de %s : %s';
        $htmlTemplate = '<html><p>Bonjour %s, vous avez reçu un message de %s : %s</p></html>';

        if($id < 10){
            return $textTemplate;
        }

        return $htmlTemplate;
    }
}
