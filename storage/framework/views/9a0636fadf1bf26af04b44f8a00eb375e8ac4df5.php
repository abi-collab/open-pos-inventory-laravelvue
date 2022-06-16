<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo e(config('app.name')); ?></title>

        <!--cdn---->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                color: black;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
            }
            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: black;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            #quote {
                color: black;
            }
          
        </style>
    </head>
    <body>
        <div class="container position-ref full-height" style="float: center; display:flex">
            <?php if(Route::has('login')): ?>
                <div class="top-left links">
                    <br>
                    LARAVEL-VUE POS & INVENTORY SYSTEM
                </div>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Login</a>
                        
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <h1 style="text-align:center; margin-top:30vh;">
            Home Page! <br> 
            Business logo / System's Manual maybe
            <br>
            <a id="quote">This system enables user to monitor item stocks inventory in real-time.</a>
            
        </h1>
 

     
        </div>
    </body>
</html>
<?php /**PATH C:\Users\Abi\open-pos-inventory-laravelvue\resources\views/welcome.blade.php ENDPATH**/ ?>