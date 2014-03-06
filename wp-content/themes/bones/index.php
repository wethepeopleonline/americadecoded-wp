<?php get_header(); ?>

<!-- <?php echo basename(__FILE__) ?> -->

<div id="content" class="container">

	<div id="inner-content" class="col-sm-8">

		<?php if(is_home()) : ?>
			<?php
				// Get all children of this post; these are our testimonials.
				$args = array(
					'name' => 'news',
					'post_type' => 'page'
				);

				// The Query
				$news_page_query = new WP_Query( $args );
			?>

			<?php if ( $news_page_query->have_posts() ) : ?>
				<?php $news_page_query->the_post(); ?>

				<!-- POSTS PAGE -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<header class="article-header">

						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

					</header>

					<section class="entry-content clearfix" itemprop="articleBody">
						<?php the_content(); ?>
					</section>
				</article>

			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

			<header class="article-header">

				<h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<p class="byline vcard"><?php
					printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', '));
				?></p>

			</header>

			<section class="entry-content clearfix">
				<?php the_excerpt(); ?>
			</section>

			<footer class="article-footer">
				<p class="tags"><?php the_tags( '<span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?></p>

			</footer>

			<?php // comments_template(); // uncomment if you want to use them ?>

		</article>

		<?php endwhile; ?>

				<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
						<?php bones_page_navi(); ?>
				<?php } else { ?>
						<nav class="wp-prev-next">
								<ul class="clearfix">
									<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
									<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
								</ul>
						</nav>
				<?php } ?>

		<?php else : ?>

				<article id="post-not-found" class="hentry clearfix">
						<header class="article-header">
							<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
					</header>
						<section class="entry-content">
							<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
					</section>
					<footer class="article-footer">
							<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
					</footer>
				</article>

		<?php endif; ?>

	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
