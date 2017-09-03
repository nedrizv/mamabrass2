<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
	'params' => [
		// Profile images paths
		  'profileImagesPath'=>'http://localhost/mamabrass/upload/profile/',
		  'profileImagesMediumPath'=>'http://localhost/mamabrass/upload/profile/medium/',
		  'profileImagesSmallPath'=>'http://localhost/mamabrass/upload/profile/small/',
		  'upload_profileImagePath'=>$_SERVER['DOCUMENT_ROOT'].'/mamabrass/upload/profile/',
	 
	 // No images pasths
		  'noImagesPath'=>'http://localhost/mamabrass/upload/no_images/',

]
];
