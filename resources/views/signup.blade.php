@extends('common layout.Container')

@section('title', 'Signup')


@section('Signup')


    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">


                <div class="col_two_third col_last nobottommargin">


                    <h3>Don't have an Account? Register Now.</h3>

                    <p>Join the biggest peer to peer lending network in Egypt </p>

                    <form id="register-form" name="register-form" class="nobottommargin" action="/signup" method="post">

                        {{csrf_field()}}

                        @method('POST')
                        <div class="col_half">
                            <label for="register-form-name"> User Name :</label>
                            <input type="text" id="register-form-name" name="name"  class="form-control" required />
                        </div>

                        <div class="col_half col_last">
                            <label for="register-form-email">Email :</label>
                            <input type="email" id="register-form-email" name="email"  class="form-control" required/>
                        </div>

                        <div class="clear"></div>


                        <div class="clear"></div>

                        <div class="col_half">
                            <label for="register-form-password">Choose Password:</label>
                            <input type="password" id="register-form-password" name="password" class="form-control" minlength="8"  required/>
                        </div>

                        <div class="col_half col_last">
                            <label for="register-form-repassword">Re-enter Password:</label>
                            <input type="password" id="register-form-repassword" name="repassword"  class="form-control" required/>
                        </div>

                        <div class="clear"></div>

                        <div class="col_half col_last">
                            <input type="checkbox"  name="Terms and conditions"  value="accept" class="form-control" required/>
                            <label > <a href="{{route('terms')}}" target="_blank"> Accept and Agrees on Terms and conditions </a></label>

                        </div>

                        <div class="clear"></div>

                        <div class="col_full nobottommargin">
                            <button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Register Now</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section><!-- #content end -->


@endsection