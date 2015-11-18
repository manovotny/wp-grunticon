wp-grunticon v4.0.0
===

Enables the use of Grunticon within WordPress.

This also allows you to insert your grunticons through shortcodes in your post through the interactive window or as follows.

```
[grunticon icon="identifier"];
```

Where **identifier** is the icon identifier (eg icon-**identifier**).

Some basic settings can also be toggled and combined as needed.

```
// Center an icon (margin: 0 auto)
[grunticon icon="identifier" center="true"]

// Change color (default #000)
[grunticon icon="identifier" color="#FFFFFF"]

// Size (default 100px)
[grunticon icon="identifier" width="500px"]
```

### Settings

After installation, change the CSS directory to where your grunticon CSS are stored. You can also modify the file names of the CSS files that are generated from grunticon.

**NOTE** This plugin does not inject the JS from grunticon into your templates (yet), only the admin section. You must include grunticon manually for now. This will be fixed in a future release.
