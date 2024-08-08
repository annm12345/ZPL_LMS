<?php
require('top.inc.php');
?>


            <!-- ================ Order Details List ================= -->
            <style>
                .details{
                    display: grid;
                    grid-template-columns: 1fr;
                }
                a{
                    text-decoration: none;
                }
                form{
                    margin-top: 3rem;
                    width: 100%;
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                }
                form input{
                    width: 100%;
                    padding: 1rem 0.5rem;
                    border: 1px solid gray;
                    border-radius: 1rem;
                    font-size: 1rem;
                }
                form input[type="submit"]{
                    width: 10%;
                    background-color: #cadf90;
                    color: blue;
                    border: none;
                    transition: all 400ms ease;
                }form input[type="submit"]:hover{
                    background-color: blue;
                    color: #fff;
                }
            </style>
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Add Schedule</h2>
                    </div>
                    <form action="" method="post">
                        <div>
                            <input type="text" name="name" placeholder="Enter event title">
                        </div>
                        <div>
                            <input type="text" name="bedge" placeholder="Enter event bedge">
                        </div>
                        <div>
                            <input type="date" name="date" >
                        </div>
                        <div>
                            <input type="text" name="description" placeholder="Please complete the learning code with the time specification regarding the study time.">
                        </div>
                        <div>
                            <input type="text" name="type" id="" placeholder="Enter the course you want to teach">
                        </div>
                        <div>
                            <input type="submit" name="add" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>