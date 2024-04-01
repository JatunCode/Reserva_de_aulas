module.exports = {
	env: {
		browser: true,
		es2021: true,
		node: true,
	},
	plugins: ["prettier"],
	extends: ["eslint:recommended", "plugin:prettier/recommended"],

	overrides: [
		{
			files: [".eslintrc.{js,cjs}"],
		},
	],
	parserOptions: {
		ecmaVersion: "latest",
		sourceType: "module",
	},
	rules: {
		"prettier/prettier": ["error", { semi: false }],
	},
};
