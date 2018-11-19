    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="<?=$linksss; ?>images/home/under.png" class="img-responsive inline" alt="">
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="testimonial bottom">
                        <h2>Testimonial</h2>
                        <div class="media">
                            <div class="pull-left">
                                <a href="#"><img src="<?=$linksss; ?>images/home/profile1.png" alt=""></a>
                            </div>
                            <div class="media-body">
                                <blockquote>Nisi commodo bresaola, leberkas venison eiusmod bacon occaecat labore tail.</blockquote>
                                <h3><a href="#">- Jhon Kalis</a></h3>
                            </div>
                         </div>
                        <div class="media">
                            <div class="pull-left">
                                <a href="#"><img src="<?=$linksss; ?>images/home/profile2.png" alt=""></a>
                            </div>
                            <div class="media-body">
                                <blockquote>Capicola nisi flank sed minim sunt aliqua rump pancetta leberkas venison eiusmod.</blockquote>
                                <h3><a href="">- Abraham Josef</a></h3>
                            </div>
                        </div>   
                    </div> 
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="contact-info bottom">
                        <h2>Contacts</h2>
                        <address>
                        E-mail: <a href="mailto:someone@example.com">email@email.com</a> <br> 
                        Phone: +1 (123) 456 7890 <br> 
                        Fax: +1 (123) 456 7891 <br> 
                        </address>

                        <h2>Address</h2>
                        <address>
                        Unit C2, St.Vincent's Trading Est., <br> 
                        Feeder Road, <br> 
                        Bristol, BS2 0UY <br> 
                        United Kingdom <br> 
                        </address>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="contact-form bottom">
                        <h2>Send a message</h2>
                        <form id="main-contact-form" name="contact-form" method="post" action="sendemail.php">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email Id">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your text here"></textarea>
                            </div>                        
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="copyright-text text-center">
                        <p>&copy; Your Company 2014. All Rights Reserved.</p>
                        <p>Crafted by <a target="_blank" href="http://designscrazed.org/">Allie</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->


    <script type="text/javascript" src="<?=$linksss; ?>template/js/jquery.js"></script>
    <script type="text/javascript" src="<?=$linksss; ?>template/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=$linksss; ?>template/js/lightbox.min.js"></script>
    <script type="text/javascript" src="<?=$linksss; ?>template/js/wow.min.js"></script>
    <script type="text/javascript" src="<?=$linksss; ?>template/js/main.js"></script>  
    <script type="text/javascript">
        function addLikes(id,action) {
            $('.demo-table #tutorial-' + id + ' li').each(function(index) {
                $(this).addClass('selected');
                $('#tutorial-' + id + ' #rating').val((index + 1));
                if(index == $('.demo-table #tutorial-' + id + ' li').index(obj)) {
                    return false;   
                }
            });
            $.ajax({
                url: "add_likes.php",
                data:'id=' + id + '&action=' + action,
                type: "POST",
                beforeSend: function() {
                    $('#tutorial-' + id + ' .btn-likes').html("<img src='loaderIcon.gif' />");
                },
                success: function(data) {
                    if (data) {
                        var likes = parseInt($('#likes-'+id).val());
                        switch(action) {
                            case "like":
                            $('#tutorial-' + id + ' .btn-likes').html('<i type="button" title="Unlike" class="unlike fa fa-heart" onClick="addLikes(' + id + ',\'unlike\')"></i>');
                            likes = likes + 1;
                            break;
                            case "unlike":
                            $('#tutorial-' + id + ' .btn-likes').html('<i type="button" title="Like" class="like fa fa-heart"  onClick="addLikes(' + id + ',\'like\')"></i>')
                            likes = likes - 1;
                            break;
                        }
                        $('#likes-' + id).val(likes);
                        if (likes > 0) {
                            $('#tutorial-' + id + ' .label-likes').html(likes + " ");
                        } else {
                            $('#tutorial-' + id + ' .label-likes').html('');
                        }
                    }
                }
            });
        }
    </script> 
    <script>
        $(document).ready(function(){
     
            $('#main-contact-form').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                var id_item = $('#itemID').val();
                $.ajax({
                    url: "add_comment.php",
                    method: "POST",
                    data: form_data,
                    dataType:"JSON",
                    success: function(data) {
                        if(data.error != '') {
                            $('#main-contact-form')[0].reset();
                            $('#comment_message').html(data.error);
                            $('#comment_id').val('0');
                            load_comment();
                        }
                    }
                })
            });

            load_comment();

            function load_comment() {
                var id_item = $('#itemID').val();
                $.ajax({
                    url: "fetch_comment.php",
                    method: "POST",
                    data: {itemID: id_item},
                    success:function(data) {
                        $('#display_comment').html(data);
                    }
                })
            }

            $(document).on('click', '.reply', function() {
                var comment_id = $(this).attr("id");
                $('#comment_id').val(comment_id);
                $('#comment_email').focus();
            });
     
        });
    </script>
</body>
</html>