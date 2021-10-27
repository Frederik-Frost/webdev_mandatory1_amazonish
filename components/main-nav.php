<nav id="main-nav">
    <div id="nav-container">
        <!-- <a href="/"><div class="logo">A</div></a>  -->
        <div class="links">
            <a href="/"  <?= $page == "home" ? "class='active'" : ""?> >
                <i class="fas fa-home"></i> 
                <span>Home</span>
            </a> 
            <a href="items" <?= $page == "items" ? "class='active'" : ""?>>
                <i class="fas fa-tag"></i>
                <span>Items</span>
            </a> 
            <a href="settings" <?= $page == "settings" ? "class='active'" : ""?>>
                <i class="fas fa-cog"></i>
                <span>Settings</span>  
            </a>
            <!-- <a href="logout"> -->
            <a onclick="onLogout()" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign out</span> 
            </a>
        </div>
    </div>
</nav>

<div onclick="cancel()" id="logoutModal" class="modal">
    <div class="modalContent">
        <p class="modalText">
            Are you sure you want to sign out?
        </p>
        <div class="actions">
            <button onclick="logout()" type="button" class="confirmBtn">Sign out</button>
            <button onclick="cancel()" type="reset" class="cancelBtn">Cancel</button>
        </div>
    </div>
</div>
<script src="js/app.js"></script>