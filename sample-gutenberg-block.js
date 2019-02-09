const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'mynamespace/mycustomblock', {
	title: __( 'My Custom Block' ),
	icon: 'lock',
	category: 'common',

	edit() {

		return ( 'This text is from My Cusom Block'	);

	},
	save() {
		return ( 'This text is from My Cusom Block'	);
	},

} );
