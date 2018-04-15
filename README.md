WordCamp Boston 2018 Theme
==========================

This is the theme used for WordCamp Boston's website. The compiled CSS is loaded by the boston.wordcamp.org site, while the child theme itself can be used in a local development environment. This CSS file is already set up in WordCamp Boston's Remote CSS setting, so any change in this repo will be automatically synced to the live site.

To work on the site:

1. To get a local install, set up the [wordpress-meta-environment](https://github.com/WordPress/meta-environment), and follow [my guide](https://ryelle.codes/2016/07/local-development-for-wordcamp-websites/) to set up a new wordcamp site, using this repo as your child theme.
2. Create a new branch
3. Make your changes in the Sass as needed, see "CSS Structure" for where things live.
4. You can run `npm run watch`, which will rebuild the CSS as you're working, and also works with [livereload](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei) (alternately you can run `npm run build` to do a one-time build of the CSS)
5. Commit your changes, including the compiled CSS
6. Create a PR for your change

_(If you're fixing something small, feel free to merge it yourself or just commit to master)_

Once merged, check that your updates are on the live site 🎉

### Style

The entire page is using one font, Adobe Caslon Pro, which we're loading from typekit (this is set up on the live site in Appearance > Fonts).

### CSS Structure

Here's an overview of where the code lives, hopefully most of this is self-explanatory though :)

#### `variables` & `mixins`

Here we have variables for the font stack, colors, icons, and page width sizes. We also have a few useful mixins, of note:

- Use `font-size` to generate rem and px values of font size.
- Use `hover-state` to add styles on hover, active, and focus - to ensure we always have focus styles.
- Use `uppercase` to get the correct uppercase styling on headers. You can optionally pass in a font size and letter spacing, useful because letter-spacing changes based on font size, but not in a programmatic way.

#### `typography`

The base typographic styles for the site, and some more general margins and styling. If it doesn't belong in a section, it probably belongs here.

#### `header`
#### `footer`
#### `comments`

These are what they sound like :)

#### `widgets`

The styling for each widget on the page, if it needs custom styles. Each widget should be a new file in `widgets/`.

#### `content`

General styles for the page content. `content/` will have files for each custom page, see [last year's theme](https://github.com/bostonwp/wordcamp-2017/tree/master/sass/content)
