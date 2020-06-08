<?php
    $msgText = '';
    $msgType = '';
    $disableForm = '';

    if(filter_has_var(INPUT_POST, 'submit')){
		
		$fullName = htmlspecialchars($_POST['fullName']);
		$email = htmlspecialchars($_POST['email']);
        $formMessage = htmlspecialchars($_POST['formMessage']);
        $extra = htmlspecialchars($_POST['extra-form']);

		
		if(!empty($fullName) && !empty($email) && !empty($formMessage)){
			
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				
				$msgText = 'Please use a valid email address';
				$msgType = 'is-danger';
			} else {
				
				$toEmail = 'info@lessoeursph.com';
				$subject = 'Contact Request From '.$fullName;
				$body = '<h2>Contact Form</h2>
                    <p><strong>Full Name: </strong>'.$fullName.'</p>
                    <p><strong>Email: </strong>'.$email.'</p>
                    <p><strong>Message body: </strong>'.$formMessage.'</p>'
                ;

				
				$headers = "MIME-Version: 1.0" ."\r\n";
				$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

				
                $headers .= "From: " .$fullName. "<".$email.">". "\r\n";
                
                if(empty($extra)) {

                    if(mail($toEmail, $subject, $body, $headers)) {
                        $msgText = 'Your email has been sent successfully! We will get back to you shortly.';
                        $msgType = 'is-success';
                        $disableForm = 'disabled';
                    } else {                   
                        $msgText = 'Unfortunately, your email was not sent. Please try again in a while.';
                        $msgType = 'is-danger';
                    }
                }
            }

		} else {
			$msgText = 'Kindly fill in all the fields';
			$msgType = 'is-danger';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Soeurs | Contact Us</title>

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script src="https://kit.fontawesome.com/3ce9093fd0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./css/main.css">
</head>

<body id="contact">
    <nav class="navbar" role="navigation" aria-label="main navigation" data-aos="fade">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://bulma.io">
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
                    <a href="contact.php" class="navbar-item nav-link is-active">Contact</a>
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
                    <li><a href="contact.php" class="nav-link is-active">Contact</a></li>
                    <li><a href="quote.php" class="button is-primary has-text-white">Get a Quote</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero is-large" data-aos="fade">
        <div class="hero-body has-text-centered">
            <h1 class="title is-1 has-text-white">Contact Us</h1>
        </div>
    </section>


    <section class="section contact-form" data-aos="fade" data-aos-duration="1000">
        <div class="container">
            <?php if($msgText != ''): ?>
            <div class="notification <?php echo $msgType; ?> is-light has-text-centered">
                <?php echo $msgText; ?>
            </div>
            <?php endif; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="field">
                    <label class="label">Full Name</label>
                    <div class="control">
                        <input class="input" type="text" name="fullName" placeholder="eg: John Doe"
                            value="<?php echo isset($_POST['fullName']) ? $fullName : ''; ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" name="email" placeholder="eg: john.doe@mail.com"
                            value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Message</label>
                    <div class="control">
                        <textarea class="textarea" name="formMessage"
                            placeholder="Type your message here..."><?php echo isset($_POST['formMessage']) ? $formMessage : ''; ?></textarea>
                    </div>
                </div>
                <input type="text" name="extra-form" class="extra-form">
                <button <?php echo $disableForm; ?> class="button is-primary submit" name="submit"
                    type="submit">Submit</button>
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
                    <li><a href="contact.php" class="nav-link is-active">Contact</a></li>
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

    <script>AOS.init();</script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="./scripts/main.js"></script>
</body>

</html>