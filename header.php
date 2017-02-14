<?php
//header( 'Cache-Control: max-age=604800' );
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=120");
header("ETag: x234dff");

?>
<?php require("inc/config.php"); ?>
<?php ob_start("ob_gzhandler");  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html lang="en" xmlns="http://www.w3.org/1999/xhtml"><head>

<meta http-equiv="Cache-Control" content="max-age=120" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<title>Enable Hover State on Bootstrap 3 Table Rows</title>-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script async src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script async src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>

<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$sell = substr($path, 0, 6);

$r = explode('/', $path);
$r = array_filter($r);
$r = array_merge($r, array());

 $r2 = $r[2];
 $r3 = $r[3];
 $r4 = $r[4];
 $r5 = $r[5];
 $r6 = $r[6];
 $r7 = $r[7];
 $r8 = $r[8];
 $r9 = $r[9];

if($sell == '/sell-' && $r[0] != 'sell-now'){
		$rsell = explode('/', $sell);

	 $querysell =  "SELECT product.id as productid, product.Description as description, productfamily.Name as familyname, productcategory.Name as catname from product INNER JOIN `carriers` ON carriers.id=product.CarrierId INNER JOIN `productfamily` ON productfamily.id=product.FamilyId INNER JOIN `productcategory` ON productcategory.id=product.CategoryId WHERE product.id =".$r[1];
	$resultsell = mysql_query($querysell);
	$resultdata = mysql_fetch_array($resultsell);

?>
				<meta name="description" content="<?php
					if($resultdata['catname'] == 'Cell Phone'){
						echo 'We buy Used '.$resultdata['familyname'].' '.$resultdata['description'].' Sell Your '.$resultdata['familyname'].' '.$resultdata['description'].' for instant cash. Get more money for your'.$resultdata['familyname'].' '.$resultdata['description'];
					}

                    if($resultdata['catname'] == 'Computers'){
						echo 'We buy Used '.$resultdata['familyname'].' '.$resultdata['description'].' Sell Your '.$resultdata['familyname'].' '.$resultdata['description'].' for instant cash. Get more money for your'.$resultdata['familyname'].' '.$resultdata['description'];
					}

					 if($resultdata['catname'] == 'Tablets'){
						echo 'We buy Used '.$resultdata['familyname'].' '.$resultdata['description'].' Sell Your '.$resultdata['familyname'].' '.$resultdata['description'].' for instant cash. Get more money for your'.$resultdata['familyname'].' '.$resultdata['description'];
					}

					 if($resultdata['catname'] == 'gadgets'){
						echo 'We buy Used '.$resultdata['familyname'].' '.$resultdata['description'].' Sell Your '.$resultdata['familyname'].' '.$resultdata['description'].' for instant cash. Get more money for your'.$resultdata['familyname'].' '.$resultdata['description'];
					}

					 if($resultdata['catname'] == 'iPod'){
						echo 'We buy Used '.$resultdata['familyname'].' '.$resultdata['description'].' Sell Your '.$resultdata['familyname'].' '.$resultdata['description'].' for instant cash. Get more money for your'.$resultdata['familyname'].' '.$resultdata['description'];
					}


                    ?>
                    " />
				<meta name="keywords" content="<?php
					if($resultdata['catname'] == 'Cell Phone'){
						echo 'sell '.$resultdata['familyname'].' '.$resultdata['description'].', '.$resultdata['familyname'].' '.$resultdata['description'].' recycling, recycle '.$resultdata['familyname'].' '.$resultdata['description'].', '.$resultdata['familyname'].' '.$resultdata['description'].' trade in, cash for'.$resultdata['familyname'].' '.$resultdata['description'].', recommerce, re-commerce, stopoint, stopoint.com, sell used'.$resultdata['familyname'].' '.$resultdata['description'].', recycle used '.$resultdata['familyname'].' '.$resultdata['description'].', sell old '.$resultdata['familyname'].' '.$resultdata['description'].', recycle old '.$resultdata['familyname'].' '.$resultdata['description'].'';
					}

					else if($resultdata['catname'] == 'Computers'){
						echo 'sell '.$resultdata['familyname'].' '.str_replace('"', '',$resultdata['description']).', '.$resultdata['familyname'].' '.str_replace('"', '',$resultdata['description']).' recycling, recycle '.$resultdata['familyname'].' '.str_replace('"', '',$resultdata['description']).', '.$resultdata['familyname'].' '.str_replace('"', '',$resultdata['description']).' trade in, cash for'.$resultdata['familyname'].' '.str_replace('"', '',$resultdata['description']).', recommerce, re-commerce, stopoint, stopoint.com, sell used'.$resultdata['familyname'].' '.str_replace('"', '',$resultdata['description']).', recycle used '.$resultdata['familyname'].' '.str_replace('"', '',$resultdata['description']).', sell old '.$resultdata['familyname'].' '.str_replace('"', '',$resultdata['description']).', recycle old '.$resultdata['familyname'].' '.str_replace('"', '',$resultdata['description']).'';
					}

					else if($resultdata['catname'] == 'Tablets'){
						echo 'sell '.$resultdata['familyname'].' '.str_replace('"', ' inches',$resultdata['description']).', '.$resultdata['familyname'].' '.str_replace('"', ' inches',$resultdata['description']).' recycling, recycle '.$resultdata['familyname'].' '.str_replace('"', ' inches',$resultdata['description']).', '.$resultdata['familyname'].' '.str_replace('"', ' inches',$resultdata['description']).' trade in, cash for'.$resultdata['familyname'].' '.str_replace('"', ' inches', $resultdata['description']).', recommerce, re-commerce, stopoint, stopoint.com, sell used'.$resultdata['familyname'].' '.str_replace('"', ' inches', $resultdata['description']).', recycle used '.$resultdata['familyname'].' '.str_replace('"', ' inches', $resultdata['description']).', sell old '.$resultdata['familyname'].' '.str_replace('"', ' inches',$resultdata['description']).', recycle old '.$resultdata['familyname'].' '.str_replace('"', ' inches',$resultdata['description']).'';
					}

					else if($resultdata['catname'] == 'gadgets'){
						echo 'sell '.$resultdata['familyname'].' '.$resultdata['description'].', '.$resultdata['familyname'].' '.$resultdata['description'].' recycling, recycle '.$resultdata['familyname'].' '.$resultdata['description'].', '.$resultdata['familyname'].' '.$resultdata['description'].' trade in, cash for'.$resultdata['familyname'].' '.$resultdata['description'].', recommerce, re-commerce, stopoint, stopoint.com, sell used'.$resultdata['familyname'].' '.$resultdata['description'].', recycle used '.$resultdata['familyname'].' '.$resultdata['description'].', sell old '.$resultdata['familyname'].' '.$resultdata['description'].', recycle old '.$resultdata['familyname'].' '.$resultdata['description'].'';
					}

					else if($resultdata['catname'] == 'iPod'){
						echo 'sell '.$resultdata['familyname'].' '.$resultdata['description'].', '.$resultdata['familyname'].' '.$resultdata['description'].' recycling, recycle '.$resultdata['familyname'].' '.$resultdata['description'].', '.$resultdata['familyname'].' '.$resultdata['description'].' trade in, cash for'.$resultdata['familyname'].' '.$resultdata['description'].', recommerce, re-commerce, stopoint, stopoint.com, sell used'.$resultdata['familyname'].' '.$resultdata['description'].', recycle used '.$resultdata['familyname'].' '.$resultdata['description'].', sell old '.$resultdata['familyname'].' '.$resultdata['description'].', recycle old '.$resultdata['familyname'].' '.$resultdata['description'].'';
					}

					else {
						echo 'stopoint,Sell your old phones,Sell Cell Phone,Sell Your iPhone 6,Sell Your iPhone 5s,Sell Your iPhone 5, Sell Your iPhone 4s, Sell Your iPad,Sell Your Samsung,Sell Tablets,,Apple iPad Trade In,iPhone Trade In, Sell Your Samsung Galaxy, electronics online for cash at Stopoint,Sell Your iPod Touch, Sell Your MacBook,Sell Your Cell Phone, Sell Surface Pro,Sell iPad mini,Trade in iPhone 6s Plus, Sell iPhone 6 Plus, Sell iPhone 6s , Trade-in iPad,Trade-in MacBook, Trade-in MacBook Pro,MacBook Air,Trade-in iMac,Trade-in iPhone';
					};
				?>" />

               <title><?php if($resultdata['catname'] == 'Cell Phone')
{
echo 'Sell '.$resultdata['description'].' | Sell Your Old & Used '.$resultdata['description'].' for Cash';
}

else if($resultdata['catname'] == 'Computers')
{
echo 'Sell '.str_replace('"', '',$resultdata['description']).' | Sell Your Old & Used '.str_replace('"', '',$resultdata['description']).' for Cash';
}

else if($resultdata['catname'] == 'Tablets')
{
echo 'Sell '.str_replace('"', ' inches',$resultdata['description']).' | Sell Your Old & Used '.str_replace('"', ' inches',$resultdata['description']).' for Cash';
}

else if($resultdata['catname'] == 'Watches')
{
echo 'Sell '.$resultdata['description'].' | Sell Your Old & Used '.$resultdata['description'].' for Cash';
}

else if($resultdata['catname'] == 'iPod')
{
echo 'Sell '.$resultdata['description'].' | Sell Your Old & Used '.$resultdata['description'].' for Cash';
}

else if($resultdata['catname'] == 'gadgets')
{
echo 'Sell '.$resultdata['description'].' | Sell Your Old & Used '.$resultdata['description'].' for Cash';
}

else { echo "Sell Your Phone | Sell Used Electronics online for Cash | Stopoint.com"; } ?>
</title>
<?php }


else if($r[0] == 'sell' && $r[1] == 'cell-phone'){
	?>
    <link rel="canonical" href="https://www.stopoint.com/sell/cell-phone" />
    <?php


		if($r3 == '' && $r4 == ''){
		if($r[2] == 'iphone'){
			?>
             <meta name="description" content="Get in the most cash by selling your iPhone to Stopoint. Sell your used iPhone online fast. 24-hr payment! Free shipping!">
    <meta name="keywords" content="Sell your iphone, Sell your cell phone, Sell apple iphone, Sell smart watch, Online sell Computers.">
    <title>iPhone Trade-In | Sell My iPhone For Cash</title>
            <?php
			}
		else if($r[2] == 'Samsung'){
			?>
             <meta name="description" content="Trade-in your <?php echo $r[2]; ?> Galaxy  with Stopoint to get the most cash. Sell your mobile <?php echo $r[2]; ?> Galaxy online fast. 24-hr payment! Free Shipping!">
    <meta name="keywords" content="Sell Old Cell Phone, Sell My Old Cell Phone, Sell My Old Phone, Sell Used Cell Phone, Selling Old Cell Phone">
    <title>Sell <?php echo $r[2]; ?> Galaxy - Sell My <?php echo $r[2]; ?> Galaxy Phone</title>
            <?php
			}
		else{
			?>
             <meta name="description" content="Sell Cell Phones at stopoint.com. Lock-in your free 30-day quote and get paid in 24 hours. Sell your phone online fast. Free Shipping!">
    <meta name="keywords" content="Sell your iphone, Sell your cell phone, Sell apple iphone, Sell smart watch, Online sell Computers.">
    <title>Sell your cell phone for cash | Selling Old Cell Phone</title>
            <?
			}
		}



	 if($r3 != '' && $r4 == ''){

		 $value = str_replace("-"," ",$r3);

		if($r[2] == 'iphone'){
			?>
            <meta name="description" content="Trade-in your <?php echo $value; ?>  with Stopoint to get the most cash. Sell your used iPhone online fast. 24-hr payment! Free Shipping!">
    <meta name="keywords" content="Sell My <?php echo $value; ?>">
    <title>Sell My <?php echo $value; ?> | stopoint</title>
            <?php
			}
		else{
			?>
            <meta name="description" content="Trade-in your <?php echo $value; ?>  with Stopoint to get the most cash. Sell your mobile <?php echo $value; ?> online fast. 24-hr payment! Free Shipping!">
    <meta name="keywords" content="sell cell phones, sell your phone, sell old phones, cell phones trade in, sell used cell phones, cell phones buy back">
    <title>Sell My <?php echo $value; ?> Phone | <?php echo $value; ?> Trade In | stopoint</title>
            <?php
			}

	}



	 if($r4 != '' && $r5 == ''){

		if($r4 == 'T-Mobile'){
			$value1 = str_replace("-", "-",$r4);
			$value = str_replace("-", " ",$r3);
			?>
            <meta name="description" content="Get in the most cash by selling your <?php echo $value1; ?> <?php echo $value; ?> to Stopoint. Sell your used phone online fast. 24-hr payment! Free shipping!" />
    <meta name="keywords" content="sell <?php echo $value; ?> <?php echo $value1; ?>, <?php echo $value; ?> <?php echo $value1; ?> trade in, <?php echo $value; ?> <?php echo $value1; ?> recycle, cash for <?php echo $value; ?> <?php echo $value1; ?>, sell used <?php echo $value; ?> <?php echo $value1; ?>, <?php echo $value; ?> <?php echo $value1; ?> buy back" />
    <title>Sell Your <?php echo $value1; ?> <?php echo $value; ?></title>
            <?php
			}
		else{
		$value1 = str_replace("-", "",$r4);
		$value = str_replace("-", " ",$r3);
		?>
        <meta name="description" content="Get in the most cash by selling your <?php echo $value1; ?> <?php echo $value; ?> to Stopoint. Sell your used phone online fast. 24-hr payment! Free shipping!" />
    <meta name="keywords" content="sell <?php echo $value; ?> <?php echo $value1; ?>, <?php echo $value; ?> <?php echo $value1; ?> trade in, <?php echo $value; ?> <?php echo $value1; ?> recycle, cash for <?php echo $value; ?> <?php echo $value1; ?>, sell used <?php echo $value; ?> <?php echo $value1; ?>, <?php echo $value; ?> <?php echo $value1; ?> buy back"/>
    <title>Sell Your <?php echo $value1; ?> <?php echo $value; ?></title>
        <?php
		}

	}


	}

else if($r[0] == 'sell' && $r[1] == 'computers'){
	?>
    <link rel="canonical" href="https://www.stopoint.com/sell/computers" />
    <?php


		if($r3 == '' && $r4 == ''){
		if($r[2] == 'Apple'){
			?>
            <meta name="description" content="Online Sell your used and old Computers.for cash at stopoint. Recycle or trade-on your Apple computers using our instant offer. Free shipping included!" />
    <meta name="keywords" content="Online sell Computers,sell apple computer, apple computer trade in, apple computer recycle, cash for apple computer, sell used apple computer, apple computer buy back" />
    <title>Sell Your Used or Old computer | Online sell Computers. </title>
            <?php
			}
		else{
			?>
           <meta name="description" content="Online Sell your used & old computer for cash at stopoint. Recycle or trade-on your <?php echo $r[2] ?> computers using our instant offer. Free shipping included!">
    <meta name="keywords" content="Online sell <?php echo $r[2] ?> computers, <?php echo $r[2] ?> computer trade in, <?php echo $r[2] ?> computer recycle, cash for <?php echo $r[2] ?> computer, sell used <?php echo $r[2] ?> computer, <?php echo $r[2] ?> computer buy back" />
    <title>Sell Your Used or Old computer | <?php echo $r[2] ?>Online sell Computers</title>
            <?php
			}

		}



	 if($r3 != '' && $r4 == ''){

		 $value = str_replace("-"," ",$r3);
		 ?>
		  <meta name="description" content="Sell your used & old <?php echo $value; ?> computer for cash at stopoint. Recycle or trade-on your Apple computers using our instant offer. Free shipping included!">
    <meta name="keywords" content="sell apple <?php echo $value; ?> computer, apple <?php echo $value; ?> computer trade in, apple <?php echo $value; ?> computer recycle, cash for apple <?php echo $value; ?> computer, sell used apple <?php echo $value; ?> computer, apple <?php echo $value; ?> computer buy back" />
    <title>Selling Old  <?php echo $value; ?> - Sell <?php echo $value; ?> for Cash</title>
		<?
	}

	 if($r4 != '' && $r5 != '' && $r7 == ""){

		$value1 = str_replace("-", " ",$r4);
		$value2 = str_replace("-", " ",$r5);
		$value3 = str_replace("-", " ",$r6);
		?>
		 <meta name="description" content="Sell your used & old computer for cash at stopoint. Recycle or trade-on your <?php echo $r[3] ?> computers using our instant offer. Free shipping included!" />
    <meta name="keywords" content="sell <?php echo $r[3] ?> computer, <?php echo $r[3] ?> computer trade in, <?php echo $r[3] ?> computer recycle, cash for <?php echo $r[2] ?> computer, sell used <?php echo $r[3] ?> computer, <?php echo $r[3] ?> computer buy back" />
    <title>Sell Your Used or Old computer | <?php echo $r[3] ?> computer Trade In | stopoint</title>
		<?php

	}

	 if($r7 != ''){
		 $value = str_replace("-", " ",$r3);
		 $value1 = str_replace("-", " ",$r4);
		$value2 = str_replace("-", " ",$r5);
		$value3 = str_replace("-", " ",$r6);

		 $querysellcomp =  "SELECT * from product where id =".$r7;
	$resultsellcomp = mysql_query($querysellcomp);
	$resultdatacomp = mysql_fetch_array($resultsellcomp);

		?>
         <meta name="description" content="Find out how much your Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?> is worth. stopoint makes it easy to sell your used iPhones, iPads, Apple products and other smartphones. Free shipping and fast payment." />
    <meta name="keywords" content="sell Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?>, Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?> recycling, recycle <?php echo str_replace('"', '',$resultdatacomp['Description']) ?>, Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?> trade in, cash for Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?>, recommerce, re-commerce, stopoint, stopoint.com, sell used Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?>, recycle used Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?>, sell old Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?>, recycle old Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?>" />
    <title>Sell Your Used or Old <?php echo str_replace('"', '',$resultdatacomp['Description']) ?> | Apple <?php echo str_replace('"', '',$resultdatacomp['Description']) ?> Trade In | stopoint</title>
        <?php
	}



	}

else if($r[0] == 'sell' && $r[1] == 'tablet'){
	?>
    <link rel="canonical" href="https://www.stopoint.com/sell/tablet" />

    <?php


		if($r3 == '' && $r4 == ''){
		if($r[2] == 'ipad'){
			?>
             <meta name="description" content="Sell your used & old iPads for cash at Stopoint. Recyle or trade-in your iPads for instant offer. Get cash for your iPad. Free shipping included!">
    <meta name="keywords" content="sell ipad, ipad trade in, ipad recycle, cash for ipad, sell used ipad, ipad buy back">
    <title>Sell Your Used or Old iPad | Apple iPad Trade In | stopoint</title>
            <?php
			}
		else if($r[2] != ''){
			?>
             <meta name="description" content="Sell <?php echo $r[2] ?> tablets for cash at stopoint.com. Recycle or trade-in your <?php echo $r[2] ?> Tablet for an instant quote. Free shipping and free quet!">
    <meta name="keywords" content="sell <?php echo $r[2] ?> Tablet, <?php echo $r[2] ?> Tablet trade in, get cash for <?php echo $r[2] ?> Tablet, <?php echo $r[2] ?> Tablet buy back">
    <title>Sell <?php echo $r[2] ?> Tablets | Trade In & Sell Your <?php echo $r[2] ?> Tablet - stopoint.com</title>
            <?php
			}
		else{
			?>
            <meta name="description" content="Sell My Tablet for Cash at Stopoint. Recycle or trade-in your tablet for instant cash. Get cash for your tablet. 24-hr payment and free shipping!">
    <meta name="keywords" content="Sell My Tablet for Cash, Sell My Tablets,Sell your iphone, Sell your cell phone, Sell apple iphone, Sell smart watch, Online sell Computers." dataid="tablets">
    <title>Sell Tablet in Cash | Used Tablets | Stopoint.com</title>
            <?php

			}
		}



	 if($r3 != '' && $r4 == ''){

		 $value = str_replace("-"," ",$r3);
		?>
		<meta name="description" content="Sell My <?php echo $value ?> Tablet for Cash at Stopoint. Recycle or trade-in your <?php echo $value ?> tablet for instant cash. Get cash for your <?php echo $value ?> tablet. 24-hr payment and free shipping!">
    <meta name="keywords" content="sell <?php echo $value ?> tablet, sell my <?php echo $value ?> tablet, sell your <?php echo $value ?> tablet, <?php echo $value ?> tablet trade in, <?php echo $value ?> tablet recycling, cash for <?php echo $value ?> tablet, sell used <?php echo $value ?> tablet, <?php echo $value ?> tablet buy back">
    <title>Sell My Used <?php echo $value; ?> Online - Selling Old <?php echo $value; ?> for Cash
    </title>
		<?php
	}

	 if($r2 == 'Apple' && $r4 != '' && $r5 == ''){

		$value1 = str_replace("-", " ",$r4);

	}


	}

else if($r[0] == 'sell' && $r[1] == 'watch'){
	?>
    <link rel="canonical" href="https://www.stopoint.com/sell/watch" />
    <?php



		if($r[1] != "" && $r2 == ''){

		?>
       <meta name="description" content="Sell Your Apple Watch for Cash. stopoint buys all conditions of the Apple Watch. Find out how much your Apple Watch is worth today!">
    <meta name="keywords" content="Sell Apple Watch, Sell smart watch">
    <title>Sell My Apple Watch | Sell smart watch </title>
        <?php
		}
		if($r[2] != "" && $r3 == '' && $r4 == ''){
		if($r[2] == 'Apple-Watch'){
			$value = str_replace("-"," ",$r[2]);
			?>
            <meta name="description" content="Sell Your Apple Watch for Cash. stopoint buys all conditions of the Apple Watch. Find out how much your Apple Watch is worth today!">
    <meta name="keywords" content="Apple Watch">
    <title>Sell My Apple Watch | How Much is My Apple Watch Worth</title>
            <?php
			}
		else if($r[2] != ""){
			?>
            <meta name="description" content="Sell Your <?php echo $r[2] ?> Watch for Cash. stopoint buys all conditions of the <?php echo $r[2] ?> Watch. Find out how much your <?php echo $r[2] ?> Watch is worth today!">
    <meta name="keywords" content="<?php echo $r[2] ?> Watch">
    <title>Sell My <?php echo $r[2] ?> Watch | How Much is My <?php echo $r[2] ?> Watch Worth</title>
            <?php
			}
		else{ ?>
			<meta name="description" content="Sell Your Apple Watch for Cash. stopoint buys all conditions of the Apple Watch. Find out how much your Apple Watch is worth today!" />
    <meta name="keywords" content="Apple Watch" />
    <title>Sell My Apple Watch | How Much is My Apple Watch Worth</title>
			<?php
			}

		}



	 if($r3 != '' && $r4 == ''){

		 $value = str_replace("-"," ",$r[2]);
	?>
     <meta name="description" content="Sell Your Apple <?php echo $value; ?> for Cash. stopoint buys all conditions of the Apple <?php echo $value; ?>. Find out how much your Apple <?php echo $value; ?> is worth today!">
    <meta name="keywords" content="Apple <?php echo $value; ?>">
    <title>Sell My Apple <?php echo $value; ?> | How Much is My Apple <?php echo $value; ?> Worth | stopoint</title>
    <?php

	}

	 if($r4 != '' && $r5 == ''){

		 $querysellwatch =  "SELECT * from product where id =".$r4;
	$resultsellwatch = mysql_query($querysellwatch);
	$resultdatawatch = mysql_fetch_array($resultsellwatch);
	?>
    <meta name="description" content="Sell Your Apple <?php echo $resultdatawatch['Description']; ?> for Cash. stopoint buys all conditions of the Apple <?php echo $resultdatawatch['Description']; ?>. Find out how much your Apple <?php echo $resultdatawatch['Description']; ?> is worth today!">
    <meta name="keywords" content="Apple <?php echo $resultdatawatch['Description']; ?>">
    <title>Sell My Apple <?php echo $resultdatawatch['Description']; ?> | How Much is My Apple <?php echo $resultdatawatch['Description']; ?> Worth | stopoint</title>
    <?php

	}


	}


else if($r[0] == 'sell' && $r[1] == 'gadgets'){
	?>
    <link rel="canonical" href="https://www.stopoint.com/sell/gadgets" />
    <?php


		if($r3 == '' && $r4 == ''){
		if($r[2] == 'Apple'){
			?>
            <meta name="description" content="Get cash for used Apple TVs and more. Sell your Apple TV players the fast and simple way. Free shipping and quick payment!">
    <meta name="keywords" content="sell apple tv, apple tv trade in, apple tv recycle, cash for apple tv, sell used apple tv, apple tv buy back">
    <title>Sell apple tv | apple tv Trade In | stopoint</title>
            <?php

			}
		else{
			?>
            <meta name="description" content="Get cash for used <?php echo $r[2]; ?> TVs and more. Sell your <?php echo $r[2]; ?> TV players the fast and simple way. Free shipping and quick payment!">
    <meta name="keywords" content="sell <?php echo $r[2]; ?> tv, <?php echo $r[2]; ?> tv trade in, <?php echo $r[2]; ?> tv recycle, cash for <?php echo $r[2]; ?> tv, sell used <?php echo $r[2]; ?> tv, <?php echo $r[2]; ?> tv buy back">
    <title>Sell <?php echo $r[2]; ?> tv | <?php echo $r[2]; ?> tv Trade In | stopoint</title>
            <?php
			}

		}



	 if($r3 != '' && $r4 == ''){

		 $value = str_replace("-"," ",$r3);
		?>
         <meta name="description" content="Get cash for used <?php echo $value; ?> TVs and more. Sell your <?php echo $value; ?> TV players the fast and simple way. Free shipping and quick payment!">
    <meta name="keywords" content="sell <?php echo $value; ?> tv, <?php echo $value; ?> tv trade in, <?php echo $value; ?> tv recycle, cash for <?php echo $value; ?> tv, sell used <?php echo $value; ?> tv, <?php echo $value; ?> tv buy back">
    <title>Sell <?php echo $value; ?> tv | <?php echo $value; ?> tv Trade In | stopoint</title>
        <?php
	}

	 if($r4 != '' && $r5 == ''){

		$value1 = str_replace("-", "",$r4);
		$_GET['generation'] = $value1;
		$file = 'gadgets.php';
	}


	if($r5 != ''){


		 $queryselltv =  "SELECT * from product where id =".$r5;
	$resultselltv = mysql_query($queryselltv);
	$resultdatatv = mysql_fetch_array($resultselltv);
	?>
    <meta name="description" content="Find out how much your <?php echo $resultdatatv['Description'] ?> is worth. stopoint makes it easy to sell your used iPhones, iPads, Apple products and other smartphones. Free shipping and 24-hr payment.">
    <meta name="keywords" content="sell <?php echo $resultdatatv['Description'] ?>, <?php echo $resultdatatv['Description'] ?> recycling, recycle <?php echo $resultdatatv['Description'] ?>, <?php echo $resultdatatv['Description'] ?> trade in, cash for <?php echo $resultdatatv['Description'] ?>, recommerce, re-commerce, stopoint, stopoint.com, sell used <?php echo $resultdatatv['Description'] ?>, recycle used <?php echo $resultdatatv['Description'] ?>, sell old <?php echo $resultdatatv['Description'] ?>, recycle old <?php echo $resultdatatv['Description'] ?>">
    <title>Sell Apple tv | Sell Your Old & Used Apple tv for Cash</title>
    <?php
	}


	}

else if($r[0] == 'sell' && $r[1] == 'ipod'){
?>
<link rel="canonical" href="https://www.stopoint.com/sell/ipod" />
<?


		if($r2 == '' && $r3 == ''){
		if($r[1] == 'ipod'){
			?>
            <meta name="description" content="Sell iPod: Sell your iPod online for instant cash. Stopoint makes easy to sell your iPod and pays in 24 hours. Free shipping included!">
    <meta name="keywords" content="Sell My iPod For Cash, Selling Old iPod For Cash, Sell Used iPod Online">
    <title>Sell My Used IPod Online - Selling Old IPod for Cash</title>
            <?php
			}
		else{
			?>
         <meta name="description" content="Sell <?php echo $r[1]; ?>: Sell your <?php echo $r[1]; ?> online for instant cash. Stopoint makes easy to sell your <?php echo $r[1]; ?> and pays in 24 hours. Free shipping included!">
    <meta name="keywords" content="sell <?php echo $r[1]; ?>, <?php echo $r[1]; ?> trade in, <?php echo $r[1]; ?> recycle, cash for <?php echo $r[1]; ?>, sell used <?php echo $r[1]; ?>, <?php echo $r[1]; ?> buy back">
    <title>Sell My iPod for Cash | iPod Trade In | stopoint</title>
            <?php

			}

		}



	 if($r2 != '' && $r3 == ''){

		 $value = str_replace("-"," ",$r2);

		?>
        <meta name="description" content="Sell your <?php echo $value ?> for cash at stopoint.com. Lock-in your instant quote for 30 days when you sell your <?php echo $value ?>. Free shipping and 24-hr payment. Get cash for your <?php echo $value ?> fast!">
    <meta name="keywords" content="sell <?php echo $value ?>, <?php echo $value ?> trade in, <?php echo $value ?> recycle, cash for <?php echo $value ?>, sell used <?php echo $value ?>, <?php echo $value ?> buy back">
    <title>Sell <?php echo $value ?> | Sell Your <?php echo $value ?> for Cash | stopoint.com</title>
        <?php
	}

	 if($r3!= '' && $r4 == ''){
		$value = str_replace("-"," ",$r2);
		$value1 = str_replace("-", " ",$r3);
		?>
        <meta name="description" content="Sell Your <?php echo $value1; ?> <?php echo $value; ?>! Recycle or trade-in <?php echo $value1; ?> <?php echo $value; ?> for cash. Get cash for your <?php echo $value1; ?> <?php echo $value; ?>. Free shipping!">
    <meta name="keywords" content="sell <?php echo $value; ?> <?php echo $value1; ?>, <?php echo $value; ?> <?php echo $value1; ?> trade in, <?php echo $value; ?> <?php echo $value1; ?> recycle, cash for <?php echo $value; ?> <?php echo $value1; ?>, sell used <?php echo $value; ?> <?php echo $value1; ?>, <?php echo $value; ?> <?php echo $value1; ?> buy back">
    <title>Sell <?php echo $value; ?> <?php echo $value1; ?> | Sell & Trade in Your <?php echo $value; ?> <?php echo $value1; ?> for Cash</title>
        <?

	}



	}

else if($r[0] == 'about'){
	?>
    <meta name="description" content="Learn about the history of Stopoint. Read about Stopoint principles. Meet the stopoint team and find out more information about us!">
    <meta name="keywords" content="If you just bought a new smart phone, you can sell your old one for cash at stopoint.com. Find out what your used smart phone is really worth today.">
    <title>Sell Used Cellphones, MP3 Players, Digital Cameras and Tablets - stopoint.com</title>
    <?php

	}

	else if($r[0] == 'privacypolicy'){
	?>
    <meta name="description" content="Sell your old phones &amp; used electronics online for cash at Stopoint. Get the most money for your smartphones, MacBooks &amp; other electronics. Free shipping and instant offers!">
    <meta name="keywords" content="stopoint,Sell your old phones,Sell Cell Phone,Sell Your iPhone 6,Sell Your iPhone 5s,Sell Your iPhone 5, Sell Your iPhone 4s, Sell Your iPad,Sell Your Samsung,Sell Tablets,,Apple iPad Trade In,iPhone Trade In, Sell Your Samsung Galaxy, electronics online for cash at Stopoint,Sell Your iPod Touch, Sell Your MacBook,Sell Your Cell Phone, Sell Surface Pro,Sell iPad mini,Trade in iPhone 6s Plus, Sell iPhone 6 Plus, Sell iPhone 6s , Trade-in iPad,Trade-in MacBook, Trade-in MacBook Pro,MacBook Air,Trade-in iMac,Trade-in iPhone">
    <title>Sell Your Phone | Trade In Your Electronics | Stopoint.com</title>
    <?php

	}

	else if($r[0] == 'termsconditions'){
	?>
    <meta name="description" content="Sell your old phones &amp; used electronics at Stopoint. Get the most money for your smartphones, MacBooks &amp; other electronics. Free shipping and instant offers!">
    <meta name="keywords" content="stopoint,Sell your old phones,Sell Cell Phone,Sell Your iPhone 6,Sell Your iPhone 5s,Sell Your iPhone 5, Sell Your iPhone 4s, Sell Your iPad,Sell Your Samsung,Sell Tablets,,Apple iPad Trade In,iPhone Trade In, Sell Your Samsung Galaxy, electronics online for cash at Stopoint,Sell Your iPod Touch, Sell Your MacBook,Sell Your Cell Phone, Sell Surface Pro,Sell iPad mini,Trade in iPhone 6s Plus, Sell iPhone 6 Plus, Sell iPhone 6s , Trade-in iPad,Trade-in MacBook, Trade-in MacBook Pro,MacBook Air,Trade-in iMac,Trade-in iPhone">
    <title>Sell Your Phone | Trade In Your Electronics | Stopoint.com</title>
    <?php

	}

	else if($r[0] == 'legal'){
	?>
    <meta name="description" content="Sell your old phones &amp; used electronics online for cash at Stopoint. Get the most money for your smartphones, MacBooks &amp; other electronics. Free shipping and 24-hr payment!" />
    <meta name="keywords" content="stopoint,Sell your old phones,Sell Cell Phone,Sell Your iPhone 6,Sell Your iPhone 5s,Sell Your iPhone 5, Sell Your iPhone 4s, Sell Your iPad,Sell Your Samsung,Sell Tablets,,Apple iPad Trade In,iPhone Trade In, Sell Your Samsung Galaxy, electronics online for cash at Stopoint,Sell Your iPod Touch, Sell Your MacBook,Sell Your Cell Phone, Sell Surface Pro,Sell iPad mini,Trade in iPhone 6s Plus, Sell iPhone 6 Plus, Sell iPhone 6s , Trade-in iPad,Trade-in MacBook, Trade-in MacBook Pro,MacBook Air,Trade-in iMac,Trade-in iPhone">
    <title>Sell Your Phone | Trade In Your Electronics | Stopoint.com</title>
    <?php

	}

	else if($r[0] == 'recycling'){
	?>
    <meta name="description" content="Sell your old phones &amp; used electronics online for cash at Stopoint. Get the most money for your smartphones, MacBooks &amp; other electronics. Free shipping and 24-hr payment.!">
    <meta name="keywords" content="stopoint,Sell your old phones,Sell Cell Phone,Sell Your iPhone 6,Sell Your iPhone 5s,Sell Your iPhone 5, Sell Your iPhone 4s, Sell Your iPad,Sell Your Samsung,Sell Tablets,,Apple iPad Trade In,iPhone Trade In, Sell Your Samsung Galaxy, electronics online for cash at Stopoint,Sell Your iPod Touch, Sell Your MacBook,Sell Your Cell Phone, Sell Surface Pro,Sell iPad mini,Trade in iPhone 6s Plus, Sell iPhone 6 Plus, Sell iPhone 6s , Trade-in iPad,Trade-in MacBook, Trade-in MacBook Pro,MacBook Air,Trade-in iMac,Trade-in iPhone">
    <title>Sell Your Phone | Trade In Your Electronics | Stopoint.com</title>
    <?php

	}

	else if($r[0] == 'press'){
	?>
    <meta name="description" content="Read about stopoint in the news. Find testimonials and articles about stopoint.com from trusted sources around the web.">
    <meta name="keywords" content="stopoint,Sell your old phones,Sell Cell Phone,Sell Your iPhone 6,Sell Your iPhone 5s,Sell Your iPhone 5, Sell Your iPhone 4s, Sell Your iPad,Sell Your Samsung,Sell Tablets,,Apple iPad Trade In,iPhone Trade In, Sell Your Samsung Galaxy, electronics online for cash at Stopoint,Sell Your iPod Touch, Sell Your MacBook,Sell Your Cell Phone, Sell Surface Pro,Sell iPad mini,Trade in iPhone 6s Plus, Sell iPhone 6 Plus, Sell iPhone 6s , Trade-in iPad,Trade-in MacBook, Trade-in MacBook Pro,MacBook Air,Trade-in iMac,Trade-in iPhone">
    <title>Sell Used Cellphones, MP3 Players, Digital Cameras and Tablets - stopoint.com</title>
    <?php

	}

	else if($r[0] == 'contact'){
	?>
    <meta name="description" content="Sell your old phones &amp; used electronics online for cash at Stopoint. Get the most money for your smartphones, MacBooks &amp; other electronics. Free shipping and 24-hr payment!" />
    <meta name="keywords" content="stopoint,Sell your old phones,Sell Cell Phone,Sell Your iPhone 6,Sell Your iPhone 5s,Sell Your iPhone 5, Sell Your iPhone 4s, Sell Your iPad,Sell Your Samsung,Sell Tablets,,Apple iPad Trade In,iPhone Trade In, Sell Your Samsung Galaxy, electronics online for cash at Stopoint,Sell Your iPod Touch, Sell Your MacBook,Sell Your Cell Phone, Sell Surface Pro,Sell iPad mini,Trade in iPhone 6s Plus, Sell iPhone 6 Plus, Sell iPhone 6s , Trade-in iPad,Trade-in MacBook, Trade-in MacBook Pro,MacBook Air,Trade-in iMac,Trade-in iPhone">
    <title>Sell Your Phone | Trade In Your Electronics | Stopoint.com</title>
    <?php

	}

	else if($r[0] == 'login'){
	?>
    <meta name="description" content="Sell your old phones &amp; used electronics online for cash at Stopoint. Get the most money for your smartphones, MacBooks &amp; other electronics. Free shipping and 24-hr payment!" />
    <meta name="keywords" content="stopoint,Sell your old phones,Sell Cell Phone,Sell Your iPhone 6,Sell Your iPhone 5s,Sell Your iPhone 5, Sell Your iPhone 4s, Sell Your iPad,Sell Your Samsung,Sell Tablets,,Apple iPad Trade In,iPhone Trade In, Sell Your Samsung Galaxy, electronics online for cash at Stopoint,Sell Your iPod Touch, Sell Your MacBook,Sell Your Cell Phone, Sell Surface Pro,Sell iPad mini,Trade in iPhone 6s Plus, Sell iPhone 6 Plus, Sell iPhone 6s , Trade-in iPad,Trade-in MacBook, Trade-in MacBook Pro,MacBook Air,Trade-in iMac,Trade-in iPhone">
    <title>Sell Your Phone | Trade In Your Electronics | Stopoint.com</title>
    <?php

	}

	else if($r[0] == 'help'){
	?>
    <meta name="description" content="Sell your old phones &amp; used electronics online for cash at Stopoint. Get the most money for your smartphones, MacBooks &amp; other electronics. Free shipping and 24-hr payment!" />
    <meta name="keywords" content="stopoint,Sell your old phones,Sell Cell Phone,Sell Your iPhone 6,Sell Your iPhone 5s,Sell Your iPhone 5, Sell Your iPhone 4s, Sell Your iPad,Sell Your Samsung,Sell Tablets,,Apple iPad Trade In,iPhone Trade In, Sell Your Samsung Galaxy, electronics online for cash at Stopoint,Sell Your iPod Touch, Sell Your MacBook,Sell Your Cell Phone, Sell Surface Pro,Sell iPad mini,Trade in iPhone 6s Plus, Sell iPhone 6 Plus, Sell iPhone 6s , Trade-in iPad,Trade-in MacBook, Trade-in MacBook Pro,MacBook Air,Trade-in iMac,Trade-in iPhone">
    <title>Sell Your Phone | Trade In Your Electronics | Stopoint.com</title>
    <?php

	}

else{
	?>
    <link rel="canonical" href="https://www.stopoint.com/" />
     <meta name="description" content="Sell your Iphone online for cash at Stopoint. Get the most money when you sell your broken iphone. Free shipping and 24-hr payment." />
    <meta name="keywords" content="Sell your iphone, Sell your cell phone, Sell apple iphone, Sell smart watch, Online sell Computers." />
    <title>Sell your Iphone - Sell Iphone | Stopoint</title>
    <?php
	}
?>
<meta name="msvalidate.01" content="B920349F9D4C5BD9215BE9BA2ABCCA3A" />
                <meta property="og:title" content="Sell your Iphone - Sell Iphone | Stopoint" />

                <meta property="og:description" content="Sell your Iphone online for cash at Stopoint. Get the most money when you sell your broken iphone. Free shipping and 24-hr payment." />

				<meta name="viewport" content="width=device-width, initial-scale=1" />



    <link type="text/css" href="<?php echo $base_url ?>/css/bootstrap.min.css" rel="stylesheet" />
            <link type="text/css" href="<?php echo $base_url ?>/css/style.css?v=1.3" rel="stylesheet" />
            <link type="text/css" href="<?php echo $base_url ?>/css/animate.css" rel="stylesheet" />
            <link type="text/css" href="<?php echo $base_url ?>/css/owl.carousel.css" rel="stylesheet" />
            <link type="text/css" href="<?php echo $base_url ?>/css/owl.theme.css" rel="stylesheet" />
            <link type="text/css" href="<?php echo $base_url ?>/css/bootstrap-glyphicons.css" rel="stylesheet" />
            <link type="text/css" href="<?php echo $base_url ?>/css/star-rating.min.css" rel="stylesheet" />
            <link type="text/css" href="<?php echo $base_url ?>/css/small.css" rel="stylesheet" />
            <link href="https://plus.google.com/+Stopointtrade" rel="publisher" />



			<link rel="shortcut icon" type="image/png" href="<?php echo $base_url ?>/stopoint.png" />

	<?php $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url1 = $_SERVER['SERVER_NAME'];

if($url1 == 'smart-theory-108719.appspot.com'){
	header('Location: https://www.stopoint.com/');
	}
if($url == 'https://smart-theory-108719.appspot.com/' || $url == 'https://smart-theory-108719.appspot.com'){
	header('Location: https://www.stopoint.com/');
	}

if($url == 'https://smart-theory-108719.appspot.com/blog' || $url=='https://smart-theory-108719.appspot.com/blog/' ){
	header('Location: https://www.stopoint.com/blog');
	}

if($url == 'https://smart-theory-108719.appspot.com/admin' || $url=='https://smart-theory-108719.appspot.com/admin/'  ){
	header('Location: https://www.stopoint.com/stopointsxgdlj123');
	}
$lastSegment = basename(parse_url($url, PHP_URL_PATH));
$lastSegment = $lastSegment;
@$last = $_REQUEST['id'];
$last = ucfirst($last );
?>


<?php
function generatePassword($_len) {
$_alphaSmall = 'abcdefghijklmnopqrstuvwxyz';
$_alphaCaps  = strtoupper($_alphaSmall);
$_numerics   = '1234567890';
$_container = $_alphaSmall.$_alphaCaps.$_numerics;
$password = '';
for($i = 0; $i < $_len; $i++){
$_rand = rand(0, strlen($_container) - 1);
$password .= substr($_container, $_rand, 1);
}
return $password;
}
@$model = $_SESSION['model'];
if(isset($_POST['price'])){
$price = $_POST['price'];
$_SESSION['price'] = $price;
}

$url = $_SERVER['REQUEST_URI'];
$expurl = explode("?",$url);

if($expurl[0] == "/recycling.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/recycling');
	}
	else if($expurl[0] == "/contact.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/contact');
	}

	else if($expurl[0] == "/privacypolicy.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/privacypolicy');
	}

	else if($expurl[0] == "/login.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/login');
	}
	else if($expurl[0] == "/pressrelease.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/press');
	}
	else if($expurl[0] == "/gadgets.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/sell/gadgets');
	}
	else if($expurl[0] == "/watch.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/sell/watch');
	}
	else if($expurl[0] == "/ipod.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/sell/ipod');
	}
	else if($expurl[0] == "/tablets.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/sell/tablet');
	}
	else if($expurl[0] == "/computers.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/sell/computers');
	}
	else if($expurl[0] == "/cellphone.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com/sell/cell-phone');
	}
	else if($expurl[0] == "/index.php" && !isset($_SERVER["QUERY_STRING"])){
	header('Location: https://www.stopoint.com');
	}

if($expurl[0] == "/thankyou.php"){
unset($_SESSION['checkout']);
unset($_SESSION['model']);
unset($_SESSION['price']);
unset($_SESSION['condition']);
unset($_SESSION['computer']);
}

?>

<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3JCt1zRS7jxoa69FI7bM2xtlgetbPcsI";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");

$(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
<!--End of Zopim Live Chat Script-->


<!--
Bing Ads tag Started
-->
<script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"5500035"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script><noscript><img src="//bat.bing.com/action/0?ti=5500035&Ver=2" height="0" width="0" style="display:none; visibility: hidden;" /></noscript>
<!--
Bing Ads tag Ended
-->

<script async src="//95273.tctm.co/t.js"></script>
		</head>
		<body class="mjt">

			<?

			$queryBannerText =  "SELECT text_banner from setting_msg WHERE id=1";
			$resultBanner = mysql_query($queryBannerText);
			$bannerData = mysql_fetch_array($resultBanner);

			?>
				<?php if($bannerData) { if( strlen($bannerData['text_banner']) > 0) { ?>
        <div class="top-banner" >
					<span><?php echo $bannerData['text_banner']; ?></span>
				</div>
			  <? } } ?>
        <div class="nk_cart">

        </div>

			<div class="topbar container-fluid">
				<div class="mobcontainer container">
					<div class="row">
                    <div class="col-sm-12">

						<a href="<?php echo $base_url ?>" style=""><img class="moblogo logo img-responsive" src="<?php echo $base_url ?>/images/logo.png" alt="Logo"/></a>
                           <div class="user_account_nk dropdown">
														<a href="https://www.stopoint.com/dashboard" class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo $base_url ?>/images/account_icn.png" alt="account"/></a>
              	<ul style="background-color:#454645; position: absolute; right: 0;left: initial;top: 100%;" class="dropdown-menu">
                	<?php
						if(isset($_SESSION['login_username'])){
					?>
                    <li class="menu-item active" style="color: #e9e9ea;"><a style='background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;padding: 15px 10px;' href='<?php echo $base_url; ?>/dashboard'>Welcome <?=strtoupper($_SESSION['login_username'])?>!</a></li>
                	<li class="menu-item active" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;padding: 15px 10px;" href="<?php echo $base_url ?>/logout"><img src="<?php echo $base_url ?>/images/topbar/icon4.png" alt="Logout"/> Logout</a></li>
                    <?php
						}elseif(isset($_SESSION['FULLNAME'])){
					?>
                    <li class="menu-item active" style="color: #e9e9ea;"> <a style='background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;padding: 15px 10px;' href='<?php echo $base_url; ?>/dashboard'>Welcome <?=strtoupper($_SESSION['FULLNAME'])?>!</a></li>
                	<li class="menu-item active" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;padding: 15px 10px;" href="<?php echo $base_url ?>/signfacebook/logout.php"><img src="<?php echo $base_url ?>/images/topbar/icon4.png" alt="Logout"/> Logout</a></li>
                    <?php
						}else{
					?>
                	<li class="menu-item active" style=""><a style="background-color:transparent; color: #e9e9ea; font-family: calibri; font-size: 16px;padding: 15px 10px;" href="<?php echo $base_url ?>/login"><img src="<?php echo $base_url ?>/images/topbar/icon4.png" alt="Login"/> Login</a></li>
                    <?php
						}
					?>
                </ul>
														</div>
<?php if(isset($_SESSION['checkout'] )!= ''){ ?>
                        <div class="mobcheckout" style="float:right; position:relative;">
							<ul class="nav pull-right">
								<li class="dropdown cartd" style="padding-left:10px;">
									<a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                    <div class="cart-menu-icon">
                                        <div id="cart-count">
                                            <div id="count" class="slideup">1</div>
                                        </div>
                                    </div>
                                    </a>
									<ul class="cart-dropdown-menu-style dropdown-menu col-lg-12 col-sm-12 col-md-12 col-xs-12" style="">
<?php
$queryproduct =  "SELECT * from product WHERE product.id=".$model;
$resultproducts = mysql_query($queryproduct);
$resultproduct = mysql_fetch_assoc($resultproducts);
?>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="border-bottom:1px solid grey; height:25px; padding:0px;">
											<strong>Previously Added Items</strong>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding:0px;">
											<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding:0px;">
												<figure style="padding:10px 0px;">
<?php
if($resultproduct['image_url'] != ""){
?>
                                                    <img class="fix img-responsive"  width="40" height="40" src="<?php echo $base_url; ?>/productimages/<?php echo $resultproduct['image_url']; ?>" alt="<?=$resultproduct['Description']?>"/>
<?php
}else{
if($resultproduct['CategoryId'] == 2){?>
                                                    <img class="img-responsive" src="<?php echo $base_url ?>/images/macbook-pro.jpg" width="40" height="40" alt="MacBook Pro" />
<?php }else if($resultproduct['CategoryId'] ==1 && $resultproduct['BrandId'] ==1){?>
                                                    <img class="img-responsive" src="<?php echo $base_url ?>/images/iphone.png" width="40" height="40" alt="IPhone" />
<?php }else if($resultproduct['CategoryId'] ==1 && $resultproduct['BrandId'] ==2){?>
                                                    <img class="img-responsive" src="<?php echo $base_url ?>/images/samsung.png" width="40" height="40" alt="Samsung" />
<?php }else if($resultproduct['CategoryId'] ==3){?>
                                                    <img class="img-responsive" src="<?php echo $base_url ?>/images/gen.png" width="40" height="40" alt="Tablets" />
<?php }else if($resultproduct['CategoryId'] ==4){?>
                                                    <img class="img-responsive" src="<?php echo $base_url ?>/images/apple_tv.png" width="40" height="40" alt="Apple Tv" />
<?php }else if($resultproduct['CategoryId'] ==5){?>
                                                    <img class="img-responsive" src="<?php echo $base_url ?>/images/apple_watch.png" width="40" height="40" alt="Apple Watch" />
<?php }}?>
												</figure>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8" style="padding:0px;">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding:10px 0 0 10px;"><?=$resultproduct['Description']?></div>
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding:0 0 0 10px;">Quantity : 1</div>
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding:0 0 10px 10px;">
                                                	<a href="<?php echo $base_url;?>/remove.php" ><img style=" border-radius:10px;" src="<?php echo $base_url ?>/images/removec.jpg" alt="Remove"/></a>
                                                </div>
											</div>
											<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding:10px 0 0 0;">
												<p class="message">$ <?=$_SESSION['price']?></p>
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="color:red; height:25px; border-top:1px solid grey; padding:0px;">
											<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding:0px;"></div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8" style="padding:5px 0 0 10px;">Sub Total:</div>
											<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding:5px 0 0 0;">$ <?=$_SESSION['price']?></div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="color:red; height:50px; padding:10px 5px 5px 0px;">
											<a href="<?php echo $base_url ?>/checkout2" ><img style=" border-radius:10px; float:right;" src="<?php echo $base_url; ?>/images/c_cashoutnow.png" alt="Cash Out Now"/></a>
										</div>
									</ul>
								</li>
							</ul>
						</div>
<?php } include "menu1.php"; ?>





						<div class="phoneno">
                        <a href="tel:+1-888-246-4919" class="phoneanchor p_for_mob">1 (888) 246-4919</a>
                        <ul class="navtop desk-navtop">

<?php
if(isset($_SESSION['login_username'])){
?>
                            <li><strong><?php echo "Welcome, <a href='".$base_url."/dashboard'>".$_SESSION['login_username']."!"; ?></a></strong></li>
                            <li><img src="<?php echo $base_url ?>/images/topbar/icon4.png" alt="Logout"/><a href="<?php echo $base_url ?>/logout.php">Logout</a></li>
<?php
}elseif(isset($_SESSION['FULLNAME'])){
?>
                            <li>
                            <img class="img-circle" src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture" alt="Profiel Image">
                            <strong><a href='<?php echo $base_url; ?>/dashboard'><?php echo "Welcome, ".$_SESSION['FULLNAME']."!"; ?></a></strong>
                            </li>
							<li><img src="<?php echo $base_url ?>/images/topbar/icon4.png" alt="Logout"/><a href="signfacebook/logout">Logout</a></li>
<?php
}else{
?>
                            <li><img src="<?php echo $base_url ?>/images/topbar/icon4.png" alt="Login"/><a href="<?php echo $base_url; ?>/login">Login</a></li>
<?php
}
?>

                            <li><img src="<?php echo $base_url ?>/images/topbar/icon5.png" alt="TrackOrder"/><a href="#myModal" data-toggle="modal">Track Order</a></li>
                            <li><img src="<?php echo $base_url ?>/images/topbar/icon6.png" alt="Help"/><a href="<?php echo $base_url ?>/help">Help</a></li>
                            <li><a href="https://www.facebook.com/stopointtrade" target="_blank"><img src="<?php echo $base_url ?>/images/topbar/facebook.png" alt="Facebook"/></a><a href="https://twitter.com/stopointtrade" target="_blank"><img src="<?php echo $base_url ?>/images/topbar/twitter.png" alt="Twitter" /></a></li>
						</ul>
                        </div>
					</div>
					</div>
<?php if(isset($_SESSION['checkout'] )!= ''){ ?>
                    <div class="checkout" style="float:right; position:relative;">
						<ul class="nav pull-right">
							<li class="dropdown cartd">
								<a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                	<div class="cart-menu-icon">
                                        <div id="cart-count">
                                            <div id="count" class="slideup">1</div>
                                        </div>
                                    </div>
                                </a>
								<ul class="cart-dropdown-menu-style dropdown-menu col-lg-12 col-sm-12 col-md-12 col-xs-12" style="">
<?php
$queryproduct =  "SELECT * from product WHERE product.id=".$model;
$resultproducts = mysql_query($queryproduct);
$resultproduct = mysql_fetch_assoc($resultproducts);
?>
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="border-bottom:1px solid grey; height:25px; padding:0px;">
										<strong>Previously Added Items</strong>
									</div>
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding:0px;">
                                    	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding:0px;">
											<figure style="padding:10px 0px;">
<?php
if($resultproduct['image_url'] != ""){
?>
                                                <img class="fix img-responsive"  width="40" height="40" src="<?php echo $base_url ?>/productimages/<?php echo $resultproduct['image_url']; ?>" alt="<?=$resultproduct['Description']?>"/>
<?php
}else{
if($resultproduct['CategoryId'] == 2){
?>
                                                <img class="img-responsive" src="<?php echo $base_url ?>/images/macbook-pro.jpg" width="40" height="40" alt="MacBook Pro">
<?php }else if($resultproduct['CategoryId'] ==1 && $resultproduct['BrandId'] ==1){?>
                                                <img class="img-responsive" src="<?php echo $base_url ?>/images/iphone.png" width="40" height="40" alt="IPhoe">
<?php }else if($resultproduct['CategoryId'] ==1 && $resultproduct['BrandId'] ==2){?>
                                                <img class="img-responsive" src="<?php echo $base_url ?>/images/samsung.png" width="40" height="40" alt="Samsung">
<?php }else if($resultproduct['CategoryId'] ==3){?>
                                                <img class="img-responsive" src="<?php echo $base_url ?>/images/gen.png" width="40" height="40" alt="Tablets">
<?php }else if($resultproduct['CategoryId'] ==4){?>
                                                <img class="img-responsive" src="<?php echo $base_url ?>/images/apple_tv.png" width="40" height="40" alt="Apple TV">
<?php }else if($resultproduct['CategoryId'] ==5){?>
                                                <img class="img-responsive" src="<?php echo $base_url ?>/images/apple_watch.png" width="40" height="40" alt="Apple Watch">
<?php }} ?>
											</figure>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8" style="padding:0px;">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding:10px 0 0 10px;"><?=$resultproduct['Description']?></div>
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding:0 0 0 10px;">Quantity : 1</div>
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="padding:0 0 10px 10px;"><a href="<?php echo $base_url;?>/remove.php" ><img style=" border-radius:10px;" src="<?php echo $base_url ?>/images/removec.jpg" alt="Remove"/></a>
											</div>
										</div>
										<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding:10px 0 0 0;">
											<p class="message">$ <?=$_SESSION['price']?></p>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="color:red; height:25px; border-top:1px solid grey; padding:0px;">
										<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding:0px;"></div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8" style="padding:5px 0 0 10px;">Sub Total:</div>
										<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2" style="padding:5px 0 0 0;">$ <?=$_SESSION['price']?></div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="color:red; height:50px; padding:10px 5px 5px 0px;">
										<a href="<?php echo $base_url; ?>/checkout2" ><img style=" border-radius:10px; float:right;" src="<?php echo $base_url ?>/images/c_cashoutnow.png" alt="Cash Out Now"/></a>
									</div>
								</ul>
							</li>
						</ul>
					</div>
<?php } ?>
                </div>
			</div>
<?php
include "menu.php";
?>

            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="row pad">
                            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <p></p>
                                </div>
                                <div class="modal-body">
                                    <h4 class="modal-title" style="text-align:justify; font-weight:bold; font-size:14px;">You can track the status of an item by entering your email address and STP number. The STP number can be found in emails received from Stopoint. It looks like STP12345678901.</h4>
                                </div>
                                <form method="post" action="orderstatus.php">
                                    <div class="form-group">
                                        <label><img src="<?php echo $base_url ?>/images/f-icon1.png" alt="Icon"/>Email Address *</label>
                                        <input type="email" class="form-control" id="orderemailaddress" name="orderemailaddress" placeholder="Email Address" required />
                                    </div>
                                    <div class="form-group">
                                        <label><img src="<?php echo $base_url ?>/images/f-icon3.png" alt="Icon"/>STP Number *</label>
                                        <input type="text" class="form-control" id="stpnumber" name="stpnumber" placeholder="STP Number" required />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="traceorder_submit" class="submit-btn">Get Order Status</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
