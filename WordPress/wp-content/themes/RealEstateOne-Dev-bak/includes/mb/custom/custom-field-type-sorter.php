<?php
if ( class_exists( 'RWMB_Field' ) ) {
	/**
	 * Class RWMB_Sorter_Field
	 */
	class RWMB_Sorter_Field extends RWMB_Field {

		public static function html( $meta, $field ) {

			ob_start();

			self::embed_js( $field['id'] );
			self::embed_css();
			$ordered_sections = self::sections_ordered_array( $meta, $field['options'] );
			?>
			<div id="sections_<?php echo esc_attr( $field['id'] ); ?>">
				<?php
				foreach ( $ordered_sections as $key => $value ) {
					echo '<div class="section" draggable="true" ><span data-value="' . $key . '">' . $value . '</span></div>';
				}
				?>
			</div>
			<input id="<?php echo esc_attr( $field['id'] ); ?>" name="<?php echo esc_attr( $field['field_name'] ); ?>" class="sorting-db" type="text" value="<?php echo esc_attr( $meta ); ?>">
			<?php

			return ob_get_clean();
		}

		public static function sections_ordered_array( $value, $options ) {
			$saved_order    = explode( ',', $value );
			$sections_order = self::clean_ordered_array( $saved_order, $options );

			return array_merge( array_flip( $sections_order ), $options );
		}


		public static function clean_ordered_array( $order, $options ) {

			$sections_order = array();

			foreach ( $order as $section ) {
				if ( array_key_exists( $section, $options ) ) {
					$sections_order[] = $section;
				}
			}

			return $sections_order;
		}

		public static function embed_js( $section_id ) {
			?>
			<script>
				$ = jQuery;
				$(document).ready(function () {

					var dragSrcEl = null;

					function handleDragStart(e) {
						this.style.opacity = '0.4';

						dragSrcEl = this;

						e.dataTransfer.effectAllowed = 'move';
						e.dataTransfer.setData('text/html', this.innerHTML);
					}

					function handleDragOver(e) {
						if (e.preventDefault) {
							e.preventDefault();
						}

						e.dataTransfer.dropEffect = 'move';

						return false;
					}

					function handleDragEnter(e) {
						this.classList.add('over');
					}

					function handleDragLeave(e) {
						this.classList.remove('over');
					}

					function handleDrop(e) {

						if (e.stopPropagation) {
							e.stopPropagation();
						}

						if (dragSrcEl !== this) {
							dragSrcEl.innerHTML = this.innerHTML;
							this.innerHTML = e.dataTransfer.getData('text/html');
						}

						return false;
					}

					function handleDragEnd(e) {

						this.style.opacity = '1';

						[].forEach.call(sections, function (section) {
							section.classList.remove('over');
						});

						var optionTexts = [];
						jQuery('<?php echo '#sections_' . esc_html( $section_id ); ?> .section').each(function () {
							optionTexts.push(jQuery(this).children('span').data('value'))
						});

						var quotedCSV = optionTexts.join(',');

						var db_input = jQuery("<?php echo '#' . esc_html( $section_id ); ?>");
						db_input.val(quotedCSV).trigger('change');
					}

					var sections = document.querySelectorAll('<?php echo '#sections_' . esc_html( $section_id ); ?> .section');

					//console.log(document.querySelectorAll('<?php echo '#sections_' . esc_html( $section_id ); ?> .section'));

					[].forEach.call(sections, function (section) {
						section.addEventListener('dragstart', handleDragStart, false);
						section.addEventListener('dragenter', handleDragEnter, false)
						section.addEventListener('dragover', handleDragOver, false);
						section.addEventListener('dragleave', handleDragLeave, false);
						section.addEventListener('drop', handleDrop, false);
						section.addEventListener('dragend', handleDragEnd, false);
					});
				});
			</script>
			<?php

		}

		public static function embed_css() {
			?>
			<style>
				[draggable] {
					-moz-user-select: none;
					-khtml-user-select: none;
					-webkit-user-select: none;
					user-select: none;
					-khtml-user-drag: element;
					-webkit-user-drag: element;
				}

				.section {
					height: auto;
					padding: 15px 0;
					width: 100%;
					float: left;
					border: 1px solid #cccccc;
					background-color: #fff;
					margin-bottom: 5px;
					text-align: center;
					font-weight: 700;
					cursor: move;
				}

				.section.over {
					border: 1px dashed #000;
					background-color: rgba(0, 133, 186, 0.31);
				}

				.sorting-db {
					display: none;
				}
			</style>
			<?php
		}
	}
}
