# Project Title

## Overview
This project is an e-commerce platform that allows users to browse and purchase products online. It features a user-friendly interface, product categories, and a shopping cart functionality.

## Project Structure
```
estore
├── views
│   ├── site
│   │   ├── index.php          # Main page displaying categories and products
│   │   └── 404.php           # Custom 404 error page
│   └── layouts
│       ├── header.php         # Header layout with navigation
│       └── footer.php         # Footer layout with copyright information
├── controllers
│   └── SiteController.php     # Handles site-related requests
├── models
│   └── Product.php            # Defines the Product model
├── config
│   └── routes.php             # Routing configuration
├── public
│   └── index.php              # Entry point of the application
└── README.md                  # Project documentation
```

## Setup Instructions
1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Set up a web server (e.g., Apache, Nginx) to serve the `public` directory.
4. Configure your database settings in the appropriate configuration files.
5. Run the application by accessing the `public/index.php` file in your web browser.

## Usage Guidelines
- Visit the homepage to browse product categories and latest products.
- Use the navigation menu to access different sections of the site.
- If you encounter a 404 error, you will be redirected to a custom error page that provides options to return to the homepage.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License.