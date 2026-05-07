<!-- menubar.php -->

<style>
    /* Basic Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Navigation Bar Styles */
    nav {
        background: #333;
        color: #fff;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .nav-links {
        list-style: none;
        display: flex;
        gap: 2rem;
    }

    .nav-links a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .nav-links a:hover {
        color: #007bff;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
        nav {
            flex-direction: column;
            gap: 1rem;
        }

        .nav-links {
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }
    }
</style>

<nav>
    <div class="logo">Simple Social Network</div>

    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="setting.php">Setting</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="signout.php">Sign out</a></li>
    </ul>
</nav>