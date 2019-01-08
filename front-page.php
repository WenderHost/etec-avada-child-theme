<?php get_header(); ?>
  <?php
  //$hero = get_field('hero');
  if( have_rows('hero') ): the_row();
    $image = get_sub_field('background_image');
    $content = get_sub_field('content');
  ?>
  <div class="row center-xs middle-xs hero" style="background-image: url(<?= $image['url'] ?>);">
    <div class="content">
      <div class="box">
        <?= $content ?>
        <?php
        $link = get_sub_field('link');
        if( $link ){
          ?><a href="<?= $link['url'] ?>" class="btn" target="<?= $link['target'] ?>"><?= $link['title'] ?> &rarr;</a><?php
        }
        ?>
      </div>
    </div>
  </div>
  <?php endif; // if( have_rows('hero') ): ?>
  <?php
  if( have_rows('intro') ): the_row();
    $intro = get_sub_field('text');
    if( $intro ):
      ?>
      <div class="row solid blue intro center-xs" style="padding-bottom: 0">
        <div class="content">
          <div class="col-xs">
            <?= $intro ?>
          </div>
        </div>
      </div>
      <?php
    endif;
    if( have_rows('buttons') ):
      echo '<div class="row center-xs solid blue"><div class="content row">';
      while( have_rows('buttons') ): the_row();
        if( have_rows('button') ): the_row();
          $icon = get_sub_field('icon');
          $link = get_sub_field('link');
          ?>
          <div class="col-xs">
            <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><?= $icon ?></a>
            <h4><a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><?= $link['title'] ?></a></h4>
          </div>
          <?php
        endif;
      endwhile;
      echo '</div><!-- /.content --></div>';
    endif;
  endif; // if( have_rows('intro') ) ?>
  <?php
  if( have_rows('events') ):
    ?>
    <div class="row center-xs events" style="padding: 60px 0 40px 0">
      <div class="content">
        <div class="col-xs">
          <h2>ETEC Friday Meetings</h2>
          <!--<p>Every Friday from 7:30-8:30 a.m. ETEC invites speakers to share interesting and pertinent information about the community, science, technology, special initiatives, and other fascinating topics.</p>-->
        </div>
      </div>
    </div>
    <div class="row center-xs events" style="padding-bottom: 40px;"><div class="content row">
    <?php
    echo '';
    while( have_rows('events') ): the_row();
      $event = get_sub_field('event');
      $thumbnail = ( has_post_thumbnail( $event ) )? get_the_post_thumbnail( $event, $size = 'full' ) : '<img src="' . get_stylesheet_directory_uri() . '/images/etec-fridays.800x400.jpg' . '" />';
      $link = get_permalink( $event );
      ?>
      <div class="col-xs event">
        <a href="<?= $link ?>"><?= $thumbnail ?></a>
        <h3 class="title" style="margin: 10px 0 0 0"><a href="<?= $link ?>"><?= get_the_title( $event ) ?></a></h3>
        <p style="margin-top: 0;"><?php echo tribe_events_event_schedule_details( $event, '', '' ); ?></p>
      </div>
      <?php
    endwhile;
    ?></div></div><?php
  endif; // if( have_rows('events') )
  ?>
  <div class="row solid green" style="padding-bottom: 3rem;">
    <div class="content row">
      <div class="col-md-8">
        <h4 style="margin-bottom: .5rem;">About ETEC</h4>
        <p style="text-align: left; margin-top: 0">Organized in 1973, the East Tennessee Economic Council (ETEC) is an independent, regional, non-profit membership organization dedicated to supporting the federal government’s missions in Oak Ridge as well as encouraging new opportunities to fully utilize the highly-skilled talent, cutting-edge technologies and unique facilities that make up the federal reservation, the University of Tennessee complex, and the TVA  region.</p>

        <p style="text-align: left;">ETEC works in strong partnership with federal contractors, DOE and NNSA representatives, state officials, small businesses, and other local economic development organizations to seek new ways to use federal investments in science and security to create prosperity, promote regional development, and explore opportunities for growth.</p>
        <p style="margin-top: 2rem;"><a href="#" class="btn blue">Learn More About ETEC &rarr;</a></p>
      </div>
      <!--<div class="col-md-4">

      </div>-->
      <div class="col-md-4">
        <h4 style="margin-bottom: .5rem;">Join ETEC</h4>
        <p style="margin-top: 0;"><em>Ready to join ETEC?</em> Find out how joining the East Tennessee Economic Council can benefit you and your business!</p>
        <p><a href="#" class="btn block blue">Join Now</a></p>
        <h4 style="margin-bottom: .5rem;">Renew Your Membership</h4>
        <p style="margin-top: 0">Looking to renew your annual East Tennessee Economic Council membership? Click the button below:</p>
        <p><a href="#" class="btn block blue">Renew Now</a></p>
      </div>
    </div>
  </div>
  <div class="row center-xs" style="padding-top: 40px;">
    <div class="col-12">
      <h2>ETEC Members</h2>
    </div>
  </div>
  <div class="row">
      <div class="col-12"><?php echo do_shortcode('[logo-slider]'); ?></div>
  </div>
  <div class="row solid blue center-xs">
    <div class="content" style="padding: 1rem 0;">
      <div class="col-xs">
        <h2 style="margin-bottom: 2.25rem;">Stay in the loop!</h2>
        <a href="#" class="btn green">Subscribe to our Newsletter!</a>
      </div>
    </div>
  </div>
<?php get_footer(); ?>