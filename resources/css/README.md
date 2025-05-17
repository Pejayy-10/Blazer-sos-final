# CSS Organization

This project uses a modular CSS organization based on the ITCSS (Inverted Triangle CSS) methodology combined with utility classes. The structure helps maintain a clean, scalable, and maintainable codebase.

## Directory Structure

```
resources/css/
├── app.css                   # Main entry point that imports all other CSS files
├── base/                     # Base styles and variables
│   ├── _animations.css       # Animation keyframes and classes
│   ├── _reset.css            # CSS reset and normalization
│   ├── _typography.css       # Text styling and fonts
│   └── _variables.css        # CSS variables and theming
├── components/               # Reusable UI components
│   ├── _badges.css           # Badge components
│   ├── _buttons.css          # Button components
│   ├── _cards.css            # Card components
│   ├── _forms.css            # Form controls and inputs
│   ├── _navigation.css       # Navigation elements
│   └── _tables.css           # Table styling
├── layouts/                  # Layout components
│   ├── _footer.css           # Footer styling
│   ├── _header.css           # Header styling
│   └── _sidebar.css          # Sidebar styling
├── pages/                    # Page-specific styles
│   ├── _auth.css             # Authentication pages
│   └── _dashboard.css        # Dashboard pages
└── utilities/                # Utility classes
    └── _helpers.css          # Helper classes and utilities
```

## Usage Guide

### Base Styles

The `base/` directory contains foundational styles and variables:

- `_variables.css`: Define color schemes, spacing, typography, and other design tokens.
- `_reset.css`: Normalize default browser styling and set base element styles.
- `_typography.css`: Define text sizes, weights, and styles.
- `_animations.css`: Define keyframe animations and transition effects.

### Components

The `components/` directory contains styles for individual UI components:

- `_buttons.css`: Various button styles (primary, secondary, sizes, states).
- `_cards.css`: Card containers with variants.
- `_forms.css`: Form controls, inputs, and form layouts.
- `_tables.css`: Table styling and variants.
- `_badges.css`: Status indicators and tag styles.
- `_navigation.css`: Navigation bars, menus, and links.

### Layouts

The `layouts/` directory defines the structure of page sections:

- `_header.css`: Top navigation and header areas.
- `_sidebar.css`: Side navigation and collapsible menus.
- `_footer.css`: Footer layouts and content.

### Pages

The `pages/` directory contains styles specific to certain pages:

- `_dashboard.css`: Dashboard layouts and components.
- `_auth.css`: Login, register, and other authentication pages.

### Utilities

The `utilities/` directory provides helper classes:

- `_helpers.css`: Utility classes for spacing, display, colors, etc.

## Theme System

The project uses CSS variables for theming, defined in `_variables.css`. Dark mode is supported through the `.dark` class and CSS variables.

## Best Practices

1. **Follow the Module Pattern**: Add new styles to the appropriate file based on their purpose.
2. **Use Variables**: Always use CSS variables for colors, spacing, and other design tokens.
3. **Mobile-First**: Design for mobile first, then use media queries to adapt for larger screens.
4. **Avoid !important**: Use it sparingly, mainly in utility classes.
5. **Comment Your Code**: Add comments for complex selectors or animations.

## Adding New Styles

When adding new CSS:

1. Determine which module it belongs to (component, layout, page, utility).
2. Add your styles to the appropriate file.
3. If creating a new component type, create a new file in the relevant directory.
4. Import the new file in `app.css` if needed.

## Browser Support

The CSS is optimized for modern browsers. We use PostCSS with Autoprefixer for vendor prefixes as needed. 