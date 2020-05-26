<?php
    $msgText = '';
    $msgType = '';
    $disableForm = '';

    if(filter_has_var(INPUT_POST, 'submit')){
		
		$fullName = htmlspecialchars($_POST['fullName']);
		$email = htmlspecialchars($_POST['email']);
		$phone = htmlspecialchars($_POST['phone']);
        $propertyType = htmlspecialchars($_POST['propertyOptions']);
        $location = htmlspecialchars($_POST['location']);
        $size = htmlspecialchars($_POST['size']);
        $budget = htmlspecialchars($_POST['budget']);
        $otherInfo = htmlspecialchars($_POST['otherInfo']);

        
		if(!empty($fullName) && !empty($email) && !empty($phone) && !empty($propertyType) && !empty($location) && !empty($size) && !empty($budget)){
			
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				
				$msgText = 'Please use a valid email address';
				$msgType = 'is-danger';
			} else {

                if(empty($otherInfo)) {
                    $otherInfo = 'No extra information provided.';
                }
				
				$toEmail = 'info@lessoeurs.com.ph';
				$subject = 'Quote Request From '.$fullName;
				$body = '<h2>Quote Request Form</h2>
                    <p><strong>Full Name: </strong>'.$fullName.'</p>
                    <p><strong>Email: </strong>'.$email.'</p>
                    <p><strong>Contact Number: </strong>'.$phone.'</p>
                    <p><strong>Property Type: </strong>'.$propertyType.'</p>
                    <p><strong>Location: </strong>'.$location.'</p>
                    <p><strong>Property Area Size: </strong>'.$size.'</p>
                    <p><strong>Budget: </strong>'.$budget.'</p>
                    <p><strong>Other Info: </strong>'.$otherInfo.'</p>'
                ;

				
				$headers = "MIME-Version: 1.0" ."\r\n";
				$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

				
                $headers .= "From: " .$fullName. "<".$email.">". "\r\n";

				if(mail($toEmail, $subject, $body, $headers)){
					$msgText = 'Your request has been submitted! We will get back to you shortly.';
                    $msgType = 'is-success';
                    $disableForm = 'disabled';
				} else {
					$msgText = 'Unfortunately, your request was not sent. Please try again in a while.';
					$msgType = 'is-danger';
				}
			}
		} else {
			$msgText = 'Kindly fill in all the required fields';
			$msgType = 'is-danger';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Souers | Get a Quote</title>

    <script src="https://kit.fontawesome.com/3ce9093fd0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./css/main.css">
</head>

<body id="quote">
    <div id="navOverlay"></div>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.html">
                    <img src="./assets/logo-icon.png">
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
                    data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div class="navbar-menu">
                <div class="navbar-end">
                    <a href="index.html" class="navbar-item nav-link">Home</a>
                    <a href="about.html" class="navbar-item nav-link">About</a>
                    <a href="services.html" class="navbar-item nav-link">Services</a>
                    <a href="projects.html" class="navbar-item nav-link">Projects</a>
                    <a href="contact.php" class="navbar-item nav-link">Contact</a>
                    <p class="navbar-item">
                        <a href="quote.php" class="button is-primary has-text-white">Get a Quote</a>
                    </p>
                </div>
            </div>

            <div class="menu-mobile">
                <ul class="navmenu">
                    <li><a href="index.html" class="nav-link">Home</a></li>
                    <li><a href="about.html" class="nav-link">About</a></li>
                    <li><a href="services.html" class="nav-link">Services</a></li>
                    <li><a href="projects.html" class="nav-link">Projects</a></li>
                    <li><a href="contact.php" class="nav-link">Contact</a></li>
                    <li><a href="quote.php" class="button is-primary has-text-white">Get a Quote</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero is-large">
        <div class="hero-body has-text-centered">
            <h1 class="title is-1 has-text-white">Get a Quote</h1>
        </div>
    </section>

    <section class="section quote-form">
        <div class="container">
        <?php if($msgText != ''): ?>
            <div class="notification <?php echo $msgType; ?> is-light has-text-centered">
                <?php echo $msgText; ?>
            </div>
        <?php endif; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="field">
                    <label class="label">Full Name<span class="has-text-danger">*</span></label>
                    <div class="control">
                        <input class="input" type="text" name="fullName" placeholder="John Doe" value="<?php echo isset($_POST['fullName']) ? $fullName : ''; ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email<span class="has-text-danger">*</span></label>
                    <div class="control">
                        <input class="input" type="email" name="email" placeholder="john.doe@mail.com" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Contact Number<span class="has-text-danger">*</span></label>
                    <div class="control">
                        <input class="input" type="text" name="phone" placeholder="09991234567" value="<?php echo isset($_POST['phone']) ? $phone : ''; ?>">
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-body">
                        <div class="field">
                            <label class="label">Type of Property<span class="has-text-danger">*</span></label>
                            <div class="control is-expanded">
                                <div class="select is-fullwidth">
                                    <select name="propertyOptions">
                                        <option>Condominium</option>
                                        <option>House and Lot</option>
                                        <option>Commercial Space</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Location of Property<span class="has-text-danger">*</span></label>
                            <div class="control is-expanded">
                                <input class="input" type="text" name="location" placeholder="Property Address" value="<?php echo isset($_POST['location']) ? $location : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Property Area Size<span class="has-text-danger">*</span></label>
                    <div class="control">
                        <input class="input" type="text" name="size" placeholder="1000 sqm" value="<?php echo isset($_POST['size']) ? $size : ''; ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Budget<span class="has-text-danger">*</span></label>
                    <div class="control">
                        <input class="input" type="text" name="budget" value="<?php echo isset($_POST['budget']) ? $budget : ''; ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Additional Info</label>
                    <div class="control">
                        <textarea class="textarea" name="otherInfo" placeholder="Start typing here..."><?php echo isset($_POST['otherInfo']) ? $otherInfo : ''; ?></textarea>
                    </div>
                </div>
                <button <?php echo $disableForm; ?> class="button is-primary submit" name="submit" type="submit">Get a Quote</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="columns">
                <div class="column brand"><img src="./assets/logo.png" alt=""></div>
                <ul class="column links">
                    <li><a href="index.html" class="nav-link">Home</a></li>
                    <li><a href="about.html" class="nav-link">About</a></li>
                    <li><a href="services.html" class="nav-link">Services</a></li>
                    <li><a href="projects.html" class="nav-link">Projects</a></li>
                    <li><a href="contact.php" class="nav-link">Contact</a></li>
                    <li><a class="button is-primary" href="quote.php">Get a Quote</a></li>
                </ul>
                <ul class="column info has-text-white">
                    <li><i class="fas fa-map-marker-alt"></i> No. 14-A Remedios St., San Antonio Valley 3
                        Paranaque City Philippines</li>
                    <li><i class="fas fa-phone"></i> (+63) 2 8355708</li>
                    <li><i class="fas fa-mobile-alt"></i> (+63) 9351711584</li>
                </ul>
            </div>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="./scripts/main.js"></script>
</body>

</html>