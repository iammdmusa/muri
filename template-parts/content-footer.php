<footer id="footer">
    <div class="footer-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <?php dynamic_sidebar('sidebar-2');?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">

                    <?php dynamic_sidebar('sidebar-3');?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <?php dynamic_sidebar('sidebar-4');?>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="copyright-txt">
                        <p>
                            <?php echo getMuriOptions('copyright_txt','muri_general');?>
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <?php getSocialProfileLink();?>
                </div>
            </div>
        </div>

    </div>
</footer>
