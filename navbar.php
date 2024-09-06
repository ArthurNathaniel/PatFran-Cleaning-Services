<div class="navbar_all">
    <a href="index.php">
        <div class="logo">

        </div>
    </a>
    <div class="nav_links">
        <a href="index.php">Home</a>
        <div class="dropdown">
            <a href="#">About Luster<span><i class="fa-solid fa-angle-down"></i></span></a>
            <div class="dropdown-content">
                <a href=""> Our Story</a>
                <a href="">Mission & Vision</a>
            </div>
        </div>
        <a href="">Services</a>
        <a href="">Testimonials</a>
        <a href="">Contact Us</a>
       
       
    </div>


    <button id="toggleButton">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>
    <div class="mobile">
    <a href="index.php">Home</a>
        <div class="dropdown">
            <a href="#">About the institution <span><i class="fa-solid fa-angle-down"></i></span></a>
            <div class="dropdown-content">
                <a href="about.php"> History / Our Mission & Vision</a>
                <a href="governing_council.php">Governing Council</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#">Academics <span><i class="fa-solid fa-angle-down"></i></span></a>
            <div class="dropdown-content">
                <a href="calendar.php">Calender</a>
                <a href="department.php">Department</a>
                <a href="handbook.php"> Students handbook / Statutes</a>

            </div>
        </div>
        <a href="src.php">SRC</a>

        <div class="dropdown">
            <a href="#">Admission <span><i class="fa-solid fa-angle-down"></i></span></a>
            <div class="dropdown-content">
                <a href="admission.php">How to apply</a>
                <a href="online_admission.php">Online Admission</a>
            </div>
        </div>
        <a href="alumni.php">Alumni</a>
        <a href="contact.php">Contact Us</a>
    </div>
</div>

<script>
    // Get the button and sidebar elements
    var toggleButton = document.getElementById("toggleButton");
    var sidebar = document.querySelector(".mobile");
    var icon = toggleButton.querySelector("i");

    // Add click event listener to the button
    toggleButton.addEventListener("click", function() {
        // Toggle the visibility of the sidebar
        if (sidebar.style.display === "none" || sidebar.style.display === "") {
            sidebar.style.display = "flex";
            sidebar.style.flexDirection = "column";
            icon.classList.remove("fa-bars-staggered");
            icon.classList.add("fa-xmark");
        } else {
            sidebar.style.display = "none";
            icon.classList.remove("fa-xmark");
            icon.classList.add("fa-bars-staggered");
        }
    });
</script>