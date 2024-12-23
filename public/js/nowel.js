document.addEventListener("DOMContentLoaded", function () {
    const konamiSound = new Audio(base_url + "/assets/sound/20241205_154249.m4a");

    $('#nowel').on("click", function () {
        konamiSound.play();
    });
});