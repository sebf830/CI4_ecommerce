<?php

namespace App\Controllers;


class Email extends BaseController
{


    /************************************************/
    /************** CONFIRM YOUR ACCOUNT *************
     /**
     * Envoi d'un mail de confirmation au client après inscription
     * Le client doit cliquer sur le lien reçu par email.
     *
     * @param
     */

    public function sendMail($name, $to, $userKey)
    {
        $from = 'sebf.dev.test@gmail.com';
        $subject = 'Confirmation de compte';
        $mesg = '<h1>Bonjour ' . $name . ', merci de votre inscription</h1><br>
               <h2>Cliquer sur le lien pour confirmer votre compte</h2><br>
                <a href="' . base_url('validation/' . $userKey) . '">J\'active mon compte</a>
                ';
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom($from, 'Venus-Shop');
        $email->setSubject($subject);
        $email->setMessage($mesg);

        if ($email->send()) {
            echo 'Success';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }

    public function relance_panier($name, $to)
    {
        $from = 'sebf.dev.test@gmail.com';
        $subject = 'Votre sélection de produits';
        $mesg = '<h2>' . ucfirst($name) . ', nous avons conservé votre séléction</h2><br>
                 <p>A tout moment, vous pourrez y accéder lors de votre prochaine connexion</p>
                <p>A bientôt</p>';
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom($from, 'Sébastien de Venus-Shop');
        $email->setSubject($subject);
        $email->setMessage($mesg);
        if ($email->send()) {
            echo 'Success';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }

    public function customer_email($customer_mail, $sujet, $message, $name)
    {
        $email = \Config\Services::email();
        $email->setTo('sebf.dev.test@gmail.com');
        $email->setFrom($customer_mail, $name);
        $email->setSubject($sujet);
        $email->setMessage($message);
        if ($email->send()) {
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }

    public static function confirmation_commande($name, $numero, $to)
    {
        $from = 'sebf.dev.test@gmail.com';
        $subject = 'Votre commande n°' . $numero;
        $mesg = '<h2>' . ucfirst($name) . ', votre commande du ' . date('d/m/Y') . ' est enregistrée!</h2><br>
                <p>Elle est enregistrée sous la réference : ' . $numero . '</p>
                 <p>Vous recevrez bientôt un mail de confirmation d\'expedition</p>
                <p>Toute l\'équipe de Venus Shop vous remercie de votre confiance</p>';
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom($from, 'Sébastien de Venus-Shop');
        $email->setSubject($subject);
        $email->setMessage($mesg);
        if ($email->send()) {
            echo 'Success';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
    public static function send_password($name, $pass, $to)
    {
        $from = 'sebf.dev.test@gmail.com';
        $subject = 'Votre demande de réinitialisation de mot de passe';
        $mesg = '<h2>' . $name . ', nous avons enregistré votre demande de mot de passe</h2><br>
                 <p>Votre mot de passe provisoire est : ' . $pass . '</p>
                <P>Vous pourrez à tout moment le modifier dans votre espace personnel (rubrique mes informations)</p>
                <p>Toute l\'équipe de Venus Shop vous remercie de nous accorder votre confiance</p>';
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom($from, 'Sébastien de Venus-Shop');
        $email->setSubject($subject);
        $email->setMessage($mesg);
        if ($email->send()) {
            echo 'Success';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
}
