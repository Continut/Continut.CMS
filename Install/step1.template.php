<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Conținut CMS Installer</title>

        <link rel="stylesheet" type="text/css" href="Install/install.css" />
        <script type="text/javascript" src="Extensions/System/Backend/Resources/Public/JavaScript/jquery/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="Install/install.js"></script>
    </head>
    <body>
        <div class="lines clear">
            <div class="line theme1"></div>
            <div class="line theme2"></div>
            <div class="line theme3"></div>
            <div class="line theme4"></div>
            <div class="line theme5"></div>
        </div>
        <div id="main" class="main">
            <p class="text-center title">
                <img src="Extensions/System/Backend/Resources/Public/Images/logo_negru.svg" height="50" alt="Conținut CMS Logo" />
                <br/>Conținut CMS Installer
            </p>
            <div class="panel panel-login" id="steps_container">
                <div class="panel-heading">
                    <strong>Step 1</strong> - Getting ready
                </div>
                <div class="panel panel-body">
                    <form method="post" class="form login" action="install.php?step=2">
                        <p>Welcome to the <strong>Conținut CMS Installer</strong>.</p>
                        <p>Before starting the installation we need to do a system check to ensure all the required software is present. We will guide you through the necessary steps.</p>
                        <p><input type="submit" class="button submit" value="Next" /></p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>