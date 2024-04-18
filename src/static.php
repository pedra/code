<?php

$file = PHAR_URL . $request;
$mime = getMime($file);

ob_end_clean();
ob_start('ob_gzhandler');

if ($mime != false && file_exists($file)) {
	header('Content-Type: ' . $mime);
	header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($file)) . ' GMT');
	header('Cache-Control: max-age=31536000');
	header('Content-Length: ' . filesize($file));

	readfile($file);
} else {
	header('HTTP/1.0 404 Not Found');
	include_once ROOT . '/html/404.html';
}

exit();

function getMime($file)
{
	$ext = explode('.', $file);
	$ext = end($ext);
	if ($ext == 'php' || $ext == 'html')
		return false;

	$_mimes = theMimes();
	return !isset($_mimes[$ext]) ? 'text/plain' : $_mimes[$ext];
}

function theMimes()
{
	return [
		'hqx' => 'application/mac-binhex40',
		'cpt' => 'application/mac-compactpro',
		'csv' => 'text/csv',
		'bin' => 'application/macbinary',
		'dms' => 'application/octet-stream',
		'lha' => 'application/octet-stream',
		'lzh' => 'application/octet-stream',
		'exe' => 'application/octet-stream',
		'class' => 'application/octet-stream',
		'psd' => 'application/x-photoshop',
		'so' => 'application/octet-stream',
		'sea' => 'application/octet-stream',
		'dll' => 'application/octet-stream',
		'oda' => 'application/oda',
		'pdf' => 'application/pdf',
		'ai' => 'application/postscript',
		'eps' => 'application/postscript',
		'ps' => 'application/postscript',
		'smi' => 'application/smil',
		'smil' => 'application/smil',
		'mif' => 'application/vnd.mif',
		'xls' => 'application/excel',
		'ppt' => 'application/powerpoint',
		'wbxml' => 'application/wbxml',
		'wmlc' => 'application/wmlc',
		'dcr' => 'application/x-director',
		'dir' => 'application/x-director',
		'dxr' => 'application/x-director',
		'dvi' => 'application/x-dvi',
		'gtar' => 'application/x-gtar',
		'gz' => 'application/x-gzip',
		'php' => 'application/x-httpd-php',
		'php4' => 'application/x-httpd-php',
		'php3' => 'application/x-httpd-php',
		'phtml' => 'application/x-httpd-php',
		'phps' => 'application/x-httpd-php-source',
		'js' => 'application/x-javascript',
		'swf' => 'application/x-shockwave-flash',
		'sit' => 'application/x-stuffit',
		'tar' => 'application/x-tar',
		'tgz' => 'application/x-tar',
		'xhtml' => 'application/xhtml+xml',
		'xht' => 'application/xhtml+xml',
		'zip' => 'application/zip',
		'mid' => 'audio/midi',
		'midi' => 'audio/midi',
		'mpga' => 'audio/mpeg',
		'mp2' => 'audio/mpeg',
		'mp3' => 'audio/mpeg',
		'aif' => 'audio/x-aiff',
		'aiff' => 'audio/x-aiff',
		'aifc' => 'audio/x-aiff',
		'ram' => 'audio/x-pn-realaudio',
		'rm' => 'audio/x-pn-realaudio',
		'rpm' => 'audio/x-pn-realaudio-plugin',
		'ra' => 'audio/x-realaudio',
		'rv' => 'video/vnd.rn-realvideo',
		'wav' => 'audio/x-wav',
		'bmp' => 'image/bmp',
		'gif' => 'image/gif',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'jpe' => 'image/jpeg',
		'png' => 'image/png',
		'tiff' => 'image/tiff',
		'tif' => 'image/tiff',
		'css' => 'text/css',
		'html' => 'text/html',
		'htm' => 'text/html',
		'shtml' => 'text/html',
		'txt' => 'text/plain',
		'text' => 'text/plain',
		'log' => 'text/plain',
		'rtx' => 'text/richtext',
		'rtf' => 'text/rtf',
		'xml' => 'text/xml',
		'xsl' => 'text/xml',
		'mpeg' => 'video/mpeg',
		'mpg' => 'video/mpeg',
		'mpe' => 'video/mpeg',
		'qt' => 'video/quicktime',
		'mov' => 'video/quicktime',
		'avi' => 'video/x-msvideo',
		'movie' => 'video/x-sgi-movie',
		'doc' => 'application/msword',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'word' => 'application/msword',
		'xl' => 'application/excel',
		'eml' => 'message/rfc822'
	];
}