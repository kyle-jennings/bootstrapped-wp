<?php wp_head(); ?>
<style>
.example{
    height: 200px;
    border: 1px;
    background-color: rgba(0,0,0,0.8);
    padding: 30px;
    border: 1px solid white;
    color: white;

}
.fluid-full{
    padding: 40px 0;
    background-image: url(http://lorempixel.com/1920/400);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;

}
.about-us {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
}

.about-us .span6 {
  background: url(http://lorempixel.com/g/1000/400);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  padding: 70px 0;
}
.about-us .span6 .sec-title {
  margin-bottom: 0;
  margin: 0 15px;
  background-color: rgba(0, 0, 0, 0.8);
  border: 1px solid white;
}
.about-us .span6 .sec-title h2 {
  color: #FFFFFF;
}
.about-us .span6 .sec-title h2::after {
  width: 70px;
}


@media (min-width: 768px) {
  .about-us .span6 .sec-title {
    width: 720px;
    margin: 20px auto;
  }
}
@media (min-width: 992px) {
  .about-us .span6 .sec-title {
    width: 455px;
    margin: 0 15px;
  }
}
@media (min-width: 1200px) {
  .about-us .span6 .sec-title {
    width: 555px;
  }
}
@media (min-width: 992px) {
  .about-us .span6 .work-with-us {
    float: right;
  }
}
</style>

<div class="fluid-full">
    <div class="container">
        <div class="row">
            <div class="span6">
                <div class="example">
                    <h1>Title</h1>
                    <p>This is a paragraph</p>
                </div>
            </div>
            <div class="span6">
              <div class="example">
                    <h1>Title</h1>
                    <p>This is a paragraph</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid about-us">
    <div class="row">
        <div class="span6">
            <div class="sec-title text-center work-with-us">
                <h2>Work With Us</h2>
            </div>
        </div>

        <div class="span6">
            <div class="sec-title text-center what-we-do">
                <h2>What We Do</h2>
            </div>
        </div>

    </div>
</div>
