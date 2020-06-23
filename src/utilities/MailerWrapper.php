<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class MailerWrapper {
	private $_mail;
	private const USERNAME = "admin@cybear.io";
	private const PASSWORD = "%Jafj25CR943*";
	private const FULL_NAME = "";

	/**
	 * MailerWrapper constructor.
	 */
	public function __construct () {
		$this->_mail = new PHPMailer();
		$this->initConfig();
		$this->smtpAuth();
	}

	private function initConfig () {
		SMTP::DEBUG_OFF;
		$this->_mail->isSMTP();
		//REMOTE
		$this->_mail->Host = 'localhost';
		$this->_mail->SMTPAuth = false;
		$this->_mail->SMTPAutoTLS = false;
		$this->_mail->Port = 25;
		//LOCAL
		/*		$this->_mail->Host = 'smtp.gmail.com';
				$this->_mail->Port = 587;
				$this->_mail->SMTPAuth = true;
				$this->_mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;*/
	}

	private function smtpAuth () {
		$this->_mail->Username = self::USERNAME;
		$this->_mail->Password = self::PASSWORD;
	}

	/**
	 * @param string $email
	 * @param string $name
	 *
	 * @return MailerWrapper
	 * @throws MailerException
	 */
	public function setFrom (string $email = self::USERNAME, string $name = self::FULL_NAME) {
		try {
			$this->_mail->setFrom($email, $name);
		}
		catch (\PHPMailer\PHPMailer\Exception $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new MailerException($exception->getMessage(), Values::getValue('ERROR_MAILER'));
		}

		return $this;
	}

	/**
	 * @param string $email
	 * @param string $name
	 *
	 * @return MailerWrapper
	 * @throws MailerException
	 */
	public function setTo (string $email, string $name) {
		try {
			$this->_mail->addAddress($email, $name);
		}
		catch (\PHPMailer\PHPMailer\Exception $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new MailerException($exception->getMessage(), Values::getValue('ERROR_MAILER'));
		}

		return $this;
	}

	/**
	 * @param string $subject
	 *
	 * @return MailerWrapper
	 */
	public function setSubject (string $subject) {
		$this->_mail->Subject = $subject;

		return $this;
	}

	/**
	 * @param string $body
	 *
	 * @return MailerWrapper
	 */
	public function setBody (string $body) {
		$this->_mail->Body = $body;
		$this->_mail->AltBody = $body;

		return $this;
	}

	/**
	 * @throws MailerException
	 */
	public function sendEmail () {
		try {
			if (!$this->_mail->send()) {
				throw new MailerException($this->_mail->ErrorInfo, Values::getValue('ERROR_MAILER'));
			}
			/*else {
				//Section 2: IMAP
				//Uncomment these to save your message in the 'Sent Mail' folder.
				#if (save_mail($mail)) {
				#    echo "Message saved!";
				#}
			}*/
		}
		catch (\PHPMailer\PHPMailer\Exception $exception) {
			Logger::exception($exception, Logger::ERROR);
			throw new MailerException($exception->getMessage(), Values::getValue('ERROR_MAILER'));
		}
	}
}

