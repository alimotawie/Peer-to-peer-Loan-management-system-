@extends('common layout.Container')

@section('title', 'sign in')


@section('signin')

    <!-- Document Wrapper
	============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap nopadding">

                <div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #444;"></div>

                <div class="section nobg full-screen nopadding nomargin">
                    <div class="container vertical-middle divcenter clearfix ">

                        <div class="row center">
                            <a href="index.html"><img src="images/logo-dark.png" alt="Canvas Logo"></a>
                        </div>

                        <div class="panel panel-default divcenter noradius noborder" style="max-width: 400px;">
                            <div class="panel-body" style="padding: 40px;">
                                <form id="login-form" name="login-form" class="nobottommargin" action="#" method="post">
                                    <h3>Login to your Account</h3>

                                    <div class="col_full">
                                        <label for="login-form-username">Email</label>
                                        <input type="text" id="login-form-username" name="login-form-username" value="" class="form-control not-dark" />
                                    </div>

                                    <div class="col_full">
                                        <label for="login-form-password">Password:</label>
                                        <input type="password" id="login-form-password" name="login-form-password" value="" class="form-control not-dark" />
                                    </div>

                                    <div class="col_full nobottommargin">
                                        <button class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" value="login">Login</button>
                                        <a href="#" class="fright">Forgot Password?</a>
                                    </div>
                                </form>


                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section><!-- #content end -->

    </div><!-- #wrapper end -->

@endsection

