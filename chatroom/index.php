<!DOCTYPE html>
<html>
<head>
<!-- Using the jquery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
    $("#animation").click(function(){
        $("#figure").animate({left: '250px'});
        //The CSS property object are passed
    });
});
</script>
<style>
.circle:before {
  content: ' \25CF';
  font-size: 200px;    
}
.circle{
        position:absolute;
    }    
</style>
</head>
<body>

<button id="animation">Start Animation</button>
<p>This example shows a basic animation using the CSS properties object parameter, keep in mind that all HTML element are static by default we need to set the element's CSS position property of the element to relative, fixed, or absolute!</p>
    
    <div id="figure" class="circle"></div>

</body>
</html>