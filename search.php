<?php
    include_once("includes/header.php");
?>

<div class="textboxContainer">
    <input type="text" class="searchInput" placeholder="Search...">
</div>

<div class="results">

</div>

<script>
    $(function()
    {
        var username = '<?php echo $userLoggedIn; ?>'; // Gets username from header file
        var timer;

        $(".searchInput").keyup(function()
        {
            clearTimeout(timer); // resetting timer

            timer = setTimeout(function() // creating new timer
            {
                var val = $(".searchInput").val(); // Gets value from text box
                console.log(val);

                if(val != "")
                {
                    $.post("ajax/getSearchResults.php", { term: val, username: username}, function(data) // ajax call that gets search results data
                    {
                        $(".results").html(data); 
                    });
                }
                else
                {
                    $(".results").html(""); // Clear results div
                }

            }, 500);

        
        })
    })
</script>