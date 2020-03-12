function volumeToggle(button)
{
    var muted = $(".previewVideo").prop("muted");
    $(".previewVideo").prop("muted", !muted);

    $(button).find("i").toggleClass("fa-volume-mute");
    $(button).find("i").toggleClass("fa-volume-up");
}

function previewEnded()
{
    $(".previewVideo").toggle(); 
    $(".previewImage").toggle(); 
}

function goBack()
{
    window.history.back();
}

function startHideTimer()
{
    var timeout = null;

    $(document).on("mousemove", function()
    {
        clearTimeout(timeout); // Resetting the timer whenever the mouse moves
        $(".watchNav").fadeIn(); // Fades in the back button and the title of the video

        timeout = setTimeout(function() // Sets the timers where after two seconds, it will hide the back button and video title
        {
            $(".watchNav").fadeOut();
        }, 2000);
    });
}

function initVideo(videoId, username) // Initializes video when page is loading in
{
    startHideTimer();
    setStartTime(videoId, username);
    updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) // updates the progress 
{
    addDuration(videoId, username)

    var timer;

    $("video").on("playing", function(event)
    {
        window.clearInterval(timer);
        timer = window.setInterval(function()
        {
            updateProgress(videoId, username, event.target.currentTime); // event.target is the video and it's getting the current time of that video
        }, 3000);
    })
    .on("ended", function(event)
    {
        setFinished(videoId, username);
        window.clearInterval(timer);
    })
}

function addDuration(videoId, username) // inserts  
{
    $.post("ajax/addDuration.php", { videoId: videoId, username: username }, function(data) // data sends the file's echoed data from the filepath that was provided in the post function
    {
        if(data !== null && data !== "")
        {
            alert(data);
        }
    })
}

function updateProgress(videoId, username, progress)
{
    $.post("ajax/updateDuration.php", { videoId: videoId, username: username, progress: progress }, function(data) // data sends the file's echoed data from the filepath that was provided in the post function
    {
        if(data !== null && data !== "")
        {
            alert(data);
        }
    })
}

function setFinished(videoId, username)
{
    $.post("ajax/setFinished.php", { videoId: videoId, username: username }, function(data) // data sends the file's echoed data from the filepath that was provided in the post function
    {
        if(data !== null && data !== "")
        {
            alert(data);
        }
    })
}

function setStartTime(videoId, username)
{
    $.post("ajax/getProgress.php", { videoId: videoId, username: username }, function(data) // data sends the file's echoed data from the filepath that was provided in the post function
    {
        if(isNaN(data)) // checks if data is a number or not, meaning if it has the progress or not
        {
            alert(data);
            return;
        }

        console.log(data);

        $("video").on("canplay", function() // when you press play, it will set where you left off when play the video
        {
            this.currentTime = data;
            $("video").off("canplay");
        })
    })
}