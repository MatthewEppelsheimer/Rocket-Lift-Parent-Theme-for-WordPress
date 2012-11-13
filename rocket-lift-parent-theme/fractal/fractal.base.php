<?php
/**
 * The MASTER Fractal template that all other templates inherit from
 *
 *
 * @package Rocket Lift Parent Theme
 * @since Rocket Lift Parent Theme 1.0
 */
?>

<?php fractal_template(); ?>

<?php fractal( 'base-override' ); ?>

<?
/**
 *	TEMPLATE PARTS
 */
?>

<?php fractal_block( 'no-results', function(){?>
	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'rocket_lift_parent_theme' ); ?></h1>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php if ( is_home() ) : ?>
	
				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'rocket_lift_parent_theme' ), admin_url( 'post-new.php' ) ); ?></p>
	
			<?php elseif ( is_search() ) : ?>
	
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'rocket_lift_parent_theme' ); ?></p>
				<?php get_search_form(); ?>
	
			<?php else : ?>
	
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'rocket_lift_parent_theme' ); ?></p>
				<?php get_search_form(); ?>
	
			<?php endif; ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 .post .no-results .not-found -->
<?php }); /* end 'no-results' block */ ?>

<?php fractal_block( 'comments', function(){?>
	<?php
		/*
		 * If the current post is protected by a password and
		 * the visitor has not yet entered the password we will
		 * return early without loading the comments.
		 */
		if ( post_password_required() )
			return;
	?>
	
		<div id="comments" class="comments-area">
	
		<?php // You can start editing here -- including this comment! ?>
	
		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
					printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'rocket_lift_parent_theme' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h2>
	
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'rocket_lift_parent_theme' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'rocket_lift_parent_theme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'rocket_lift_parent_theme' ) ); ?></div>
			</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
			<?php endif; // check for comment navigation ?>
	
			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use rocket_lift_parent_theme_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define rocket_lift_parent_theme_comment() and that will be used instead.
					 * See rocket_lift_parent_theme_comment() in inc/template-tags.php for more.
					 */
					wp_list_comments( array( 'callback' => 'rocket_lift_parent_theme_comment' ) );
				?>
			</ol><!-- .commentlist -->
	
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'rocket_lift_parent_theme' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'rocket_lift_parent_theme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'rocket_lift_parent_theme' ) ); ?></div>
			</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
			<?php endif; // check for comment navigation ?>
	
		<?php endif; // have_comments() ?>
	
		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'rocket_lift_parent_theme' ); ?></p>
		<?php endif; ?>
	
		<?php comment_form(); ?>
	
	</div><!-- #comments .comments-area -->
<?php }); /* end 'comments' block */ ?>

<?php
/**
 *	BASE TEMPLATE
 */
?>

<?php fractal_block( 'base', function(){?><!DOCTYPE html>
	<html <?php language_attributes(); ?>>

	<head>
	<?php fractal_block( 'html-head', function(){?>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 */
			global $page, $paged;
		
			wp_title( '|', true, 'right' );
		
			// Add the blog name.
			bloginfo( 'name' );
		
			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";
		
			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', 'rocket_lift_parent_theme' ), max( $paged, $page ) );
		
			?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		
		<?php fractal_wp_head(); ?>
	<?php }); /* end 'html-head' fractal block */ ?>
	</head>

	<body <?php body_class(); ?>>
	<?php fractal_block( 'html-body', function() { ?>
		<div id="page" class="hfeed site">
			<?php do_action( 'before' ); ?>
			<header id="masthead" class="site-header" role="banner">
				<hgroup>
					<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php fractal_block( 'header-site-description', function(){?><h2 class="site-description"><?php bloginfo( 'description' ); ?></h2><?php }); ?>
				</hgroup>
		
				<nav role="navigation" class="site-navigation main-navigation">
					<h1 class="assistive-text"><?php _e( 'Menu', 'rocket_lift_parent_theme' ); ?></h1>
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'rocket_lift_parent_theme' ); ?>"><?php _e( 'Skip to content', 'rocket_lift_parent_theme' ); ?></a></div>
		
					<?php fractal_wrap( function() { wp_nav_menu( array( 'theme_location' => 'primary' ) ); } ); ?>
				</nav><!-- .site-navigation .main-navigation -->
			</header><!-- #masthead .site-header -->
		
			<div id="main" class="site-main">
				<?php fractal_block( 'main', function(){?>
					<div id="primary" class="content-area">
						<?php fractal_block( 'primary', function(){ ?>
							<div id="content" class="site-content" role="main">
								<?php fractal_block( 'content', function(){ ?>
				
									<?php if ( have_posts() ) : ?>
						
										<?php /* Start the Loop */ ?>
										<?php while ( have_posts() ) : the_post(); ?>
											<?php fractal_block( 'content-loop-inside', function(){?>
																		
												<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
													<header class="entry-header">
														<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'rocket_lift_parent_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
												
														<?php if ( 'post' == get_post_type() ) : ?>
														<div class="entry-meta">
															<?php rocket_lift_parent_theme_posted_on(); ?>
														</div><!-- .entry-meta -->
														<?php endif; ?>
													</header><!-- .entry-header -->
												
													<?php if ( is_search() ) : // Only display Excerpts for Search ?>
													<div class="entry-summary">
														<?php the_excerpt(); ?>
													</div><!-- .entry-summary -->
													<?php else : ?>
													<div class="entry-content">
														<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'rocket_lift_parent_theme' ) ); ?>
														<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'rocket_lift_parent_theme' ), 'after' => '</div>' ) ); ?>
													</div><!-- .entry-content -->
													<?php endif; ?>
												
													<footer class="entry-meta">
														<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
															<?php
																/* translators: used between list items, there is a space after the comma */
																$categories_list = get_the_category_list( __( ', ', 'rocket_lift_parent_theme' ) );
																if ( $categories_list && rocket_lift_parent_theme_categorized_blog() ) :
															?>
															<span class="cat-links">
																<?php printf( __( 'Posted in %1$s', 'rocket_lift_parent_theme' ), $categories_list ); ?>
															</span>
															<?php endif; // End if categories ?>
												
															<?php
																/* translators: used between list items, there is a space after the comma */
																$tags_list = get_the_tag_list( '', __( ', ', 'rocket_lift_parent_theme' ) );
																if ( $tags_list ) :
															?>
															<span class="sep"> | </span>
															<span class="tag-links">
																<?php printf( __( 'Tagged %1$s', 'rocket_lift_parent_theme' ), $tags_list ); ?>
															</span>
															<?php endif; // End if $tags_list ?>
														<?php endif; // End if 'post' == get_post_type() ?>
												
														<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
														<span class="sep"> | </span>
														<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'rocket_lift_parent_theme' ), __( '1 Comment', 'rocket_lift_parent_theme' ), __( '% Comments', 'rocket_lift_parent_theme' ) ); ?></span>
														<?php endif; ?>
												
														<?php edit_post_link( __( 'Edit', 'rocket_lift_parent_theme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
													</footer><!-- .entry-meta -->
												</article><!-- #post-<?php the_ID(); ?> -->
											
											<?php }); /* end 'content-loop-inside' fractal block */ ?>
						
										<?php endwhile; ?>
						
										<?php rocket_lift_parent_theme_content_nav( 'nav-below' ); ?>
						
									<?php else : ?>						
										<?php fractal_block( 'no-results', function(){ fractal_parent(); }); ?>
									<?php endif; ?>
				
								<?php }); /* end 'content' fractal block */ ?>
							</div><!-- #content .site-content -->
						<?php }); /* end 'primary' fractal block */ ?>
					</div><!-- #primary .content-area -->

					<div id="secondary" class="widget-area" role="complementary">					
						<?php fractal_block( 'sidebar', function(){ ?>
							<?php do_action( 'before_sidebar' ); ?>
							<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
				
								<aside id="search" class="widget widget_search">
									<?php get_search_form(); ?>
								</aside>
				
								<aside id="archives" class="widget">
									<h1 class="widget-title"><?php _e( 'Archives', 'rocket_lift_parent_theme' ); ?></h1>
									<ul>
										<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
									</ul>
								</aside>
				
								<aside id="meta" class="widget">
									<h1 class="widget-title"><?php _e( 'Meta', 'rocket_lift_parent_theme' ); ?></h1>
									<ul>
										<?php wp_register(); ?>
										<li><?php wp_loginout(); ?></li>
										<?php wp_meta(); ?>
									</ul>
								</aside>
				
							<?php endif; // end sidebar widget area ?>
						<?php }); /* end 'sidebar' fractal block */ ?>
					</div><!-- #secondary .widget-area -->
				<?php }) /* end 'main' fractal block */ ?>
			</div><!-- #main .site-main -->
		
			<footer id="colophon" class="site-footer" role="contentinfo">
				<?php fractal_block( 'html-footer', function() { ?>
					<div class="site-info">
						<?php do_action( 'rocket_lift_parent_theme_site_info' ); ?>
						<?php do_action( 'rocket_lift_parent_theme_attribution' ); ?>
					</div><!-- .site-info -->
				<?php }); /* end 'html-footer' fractal */ ?>
			</footer><!-- #colophon .site-footer -->
			
		</div><!-- #page .hfeed .site -->
		
		<?php fractal_wp_footer(); ?>		
	<?php }); /* end 'html-body' fractal */ ?>
	</body>

	</html>
<?php }); /* end 'base' fractal */ ?>

<?php fractal();
