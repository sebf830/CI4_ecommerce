<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{

	public $fromEmail;

	public $fromName;

	public $recipients;

	public $userAgent = 'CodeIgniter';

	public $protocol = 'smtp';

	public $mailPath = '/usr/sbin/sendmail';

	/**
	 * serveur SMTP
	 * Utilisez votre serveur 
	 *
	 */
	public $SMTPHost = 'smtp.googlemail.com';

	/**
	 * SMTP Username
	 * Votre adresse email
	 */
	public $SMTPUser = 'sebf.dev.test@gmail.com';

	/**
	 * SMTP Password
	 * Votre mot de passe de messagerie
	 */
	public $SMTPPass = 'sebfdevtest';

	/**
	 * SMTP Port
	 * Le port de votre messagerie 
	 * 465 pour google
	 */
	public $SMTPPort = 465;

	public $SMTPTimeout = 60;

	public $SMTPKeepAlive = false;

	public $SMTPCrypto = 'ssl';

	public $wordWrap = true;

	public $wrapChars = 76;

	public $mailType = 'html';

	public $charset = 'UTF-8';

	public $validate = false;

	public $priority = 3;

	public $CRLF = "\r\n";

	public $newline = "\r\n";

	public $BCCBatchMode = false;

	public $BCCBatchSize = 200;

	public $DSN = false;
}
