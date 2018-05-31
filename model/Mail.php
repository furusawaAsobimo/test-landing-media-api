<?php

class Mail
{
	// メールアドレスバリデーションパターン
	const POSIX_PATTERN_MAIL_ADDRESS = "/^[a-zA-Z0-9\-\._]+@[a-zA-Z0-9\-\._]+$/";

	public function sendMail($toAddress, $fromAddress, $subject, $message, $replyTo = null)
	{
		// カレントの言語設定
		mb_language('uni');

		// 内部文字エンコーディング
		mb_internal_encoding('UTF-8');

		// X-PHP-Originating-Script を追加
		ini_set('mail.add_x_header', 0);

		// 差出人・件名・本文設定
		$mailFrom = "<{$fromAddress}>";
		$mailSubject = preg_replace("/\r\n|\r/", "\n", $subject);
		$mailBody = preg_replace("/\r\n|\r|\n/", "\n", $message);

		// 追加ヘッダ設定
		$headers = 'From: ' . $mailFrom;
		if (!is_null($replyTo)) {
			$headers .= "\nReply-To: {$replyTo}";
		}

		// 追加パラメタ設定
		$param = "-f{$fromAddress}";

		// 送信処理->結果返却
		return mb_send_mail($toAddress, $mailSubject, $mailBody, $headers, $param);
	}
}