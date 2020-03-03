<div>

	<?php
	  header('Content-type: image/jpeg');
		// header('Content-type: image/gif');
		// header('Content-type: image/png');
	  $avatar_image = imagecreate(50, 50);
	  $string =  $initial; //compact
	  $name = $username; //compact
	  // var_dump($name);
	  // $hex = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
	  // $randomColor = '#'.$hex[rand(0,15)].$hex[rand(0,15)].$hex[rand(0,15)].$hex[rand(0,15)].$hex[rand(0,15)].$hex[rand(0,15)];
		$background = imagecolorallocate($avatar_image, rand(0,255), rand(0,255), rand(0,255)); 
		$text_colour = imagecolorallocate($avatar_image, 255, 255, 255);// imagecolorallocate($avatar_image, 0, 0, 0); 
		$line_colour = imagecolorallocate($avatar_image, 0, 0, 0); 
		// bool imagestring ( resource $image , int $font , int $x , int $y , string $string , int $color )
		imagestring( $avatar_image, 5, 17, 17, $string , $text_colour );
		// bool imagesetthickness ( resource $image , int $thickness )
		imagesetthickness ( $avatar_image, 7 );
		// bool imageline ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $color )
		//imageline( $avatar_image, 30, 45, 165, 45, $line_colour );
		imagejpeg( $avatar_image, "image/default/".$name."DefaultAvatar.jpeg" );
		// imagecolordeallocate( $line_color );
		// imagecolordeallocate( $text_color );
		// imagecolordeallocate( $background );
		// imagedestroy( $avatar_image );
	?>

</div>