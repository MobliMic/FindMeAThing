<?php
	require_once('../.core/core.class.php');
	$pageSettings = [
		'views' => [
			'header' => [
				'pageName' => 'Error',
				'sass'     => ['main' => true],
				'js'       => ['main' => true]
			],
			'body'   => true,
			'footer' => true
		],
		'forms' => true
	];
	$thisPage = new HC_Page($pageSettings);
	$body = & $thisPage->body;

	// Render Header
	$thisPage->renderView('header');

	// Get the error code
	if (isset($_GET['c'])) {
		$errorcode = $_GET['c'];
	} else {
		$errorcode = 500;
	}
	// Setup the corresponding titles
	$errortitle = [
		'400' => 'Bad Request',
		'401' => 'Unauthorized',
		'403' => 'Forbidden',
		'404' => 'Not Found',
		'405' => 'Method Not Allowed',
		'406' => 'Not Acceptable',
		'408' => 'Request Timeout',
		'409' => 'Conflict',
		'410' => 'Gone',
		'411' => 'Length Required',
		'412' => 'Precondition Failed',
		'413' => 'Request Entity Too Large',
		'414' => 'Request-URI Too Long',
		'415' => 'Unsupported Media Type',
		'416' => 'Requested Range Not Satisfiable',
		'417' => 'Expectation Failed',
		'422' => 'Unprocessable Entity (WebDAV)',
		'423' => 'Locked (WebDAV)',
		'424' => 'Failed Dependency (WebDAV)',
		'425' => 'Unordered Collection',
		'428' => 'Precondition Required',
		'429' => 'Too Many Requests',
		'431' => 'Request Header Fields Too Large',
		'444' => 'No Response',
		'449' => 'Retry With',
		'450' => 'Blocked by Windows Parental Controls',
		'499' => 'Client Closed Request',
		'500' => 'Internal Server Error',
		'501' => 'Not Implemented',
		'502' => 'Bad Gateway',
		'503' => 'Service Unavailable',
		'504' => 'Gateway Timeout',
		'505' => 'HTTP Version Not Supported',
		'506' => 'Variant Also Negotiates',
		'507' => 'Insufficient Storage (WebDAV)',
		'509' => 'Bandwidth Limit Exceeded',
		'510' => 'Not Extended',
		'511' => 'Network Authentication Required'
	];
	// Setup the corresponding descriptions
	$errordescription = [
		'400' => 'The request cannot be fulfilled due to bad syntax.',
		'401' => 'Similar to 403 Forbidden, but specifically for use when authentication is possible but has failed or not yet been provided.',
		'403' => 'The request was a legal request, but the server is refusing to respond to it.',
		'404' => 'The requested resource could not be found but may be available again in the future.',
		'405' => 'A request was made of a resource using a request method not supported by that resource.',
		'406' => 'The requested resource is only capable of generating content not acceptable according to the Accept headers sent in the request.',
		'408' => 'The server timed out waiting for the request.',
		'409' => 'Indicates that the request could not be processed because of conflict in the request, such as an edit conflict.',
		'410' => 'Indicates that the resource requested is no longer available and will not be available again.',
		'411' => 'The request did not specify the length of its content, which is required by the requested resource.',
		'412' => 'The server does not meet one of the preconditions that the requester put on the request.',
		'413' => 'The request is larger than the server is willing or able to process.',
		'414' => 'The URI provided was too long for the server to process.',
		'415' => 'The request entity has a media type which the server or resource does not support.',
		'416' => 'The client has asked for a portion of the file, but the server cannot supply that portion.',
		'417' => 'The server cannot meet the requirements of the Expect request-header field.',
		'422' => 'The request was well-formed but was unable to be followed due to semantic errors.',
		'423' => 'The resource that is being accessed is locked.',
		'424' => 'The request failed due to failure of a previous request.',
		'425' => 'The client should switch to a different protocol such as TLS/1.0.',
		'428' => 'The origin server requires the request to be conditional.',
		'429' => 'The user has sent too many requests in a given amount of time.',
		'431' => 'The server is unwilling to process the request because either an individual header field, or all the header fields collectively, are too large.',
		'444' => 'The server returns no information to the client and closes the connection.',
		'449' => 'The request should be retried after performing the appropriate action.',
		'450' => 'This error is given when Windows Parental Controls are turned on and are blocking access to the given webpage.',
		'499' => 'This code is introduced to log the case when the connection is closed by client while HTTP server is processing its request, making server unable to send the HTTP header back.',
		'500' => 'A generic error message, given when no more specific message is suitable.',
		'501' => 'The server either does not recognise the request method, or it lacks the ability to fulfill the request.',
		'502' => 'The server was acting as a gateway or proxy and received an invalid response from the upstream server.',
		'503' => 'The server is currently unavailable (because it is overloaded or down for maintenance).',
		'504' => 'The server was acting as a gateway or proxy and did not receive a timely response from the upstream server.',
		'505' => 'The server does not support the HTTP protocol version used in the request.',
		'506' => 'Transparent content negotiation for the request results in a circular reference.',
		'507' => 'The server is unable to store the representation needed to complete the request.',
		'509' => 'The server\'s bandwidth limit was exceeded.',
		'510' => 'Further extensions to the request are required for the server to fulfill it.',
		'511' => 'The client needs to authenticate to gain network access.'
	];
	http_response_code($errorcode);
?>
	<article id="article1">
		<h1>Error - <?php echo $errorcode . ' ' . $errortitle[$errorcode]; ?></h1>

		<div class="articleBody clear">
			<p><?php echo $errordescription[$errorcode]; ?></p>
		</div>
	</article>
<?php
	// Render Footer
	$thisPage->renderView('footer');
?>