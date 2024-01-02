# Price Comparison Website

## Overview

This project features a website that provides users with price comparisons of similar items from Best Buy and AT&T. The system employs a combination of Bash, Python, MySQL, PHP, HTML, and CSS to automate the process of gathering data, parsing information, and presenting it to the user.

## Workflow

1. **Data Collection**:
   - A Bash script runs infinitely every 6 hours, downloading links from the provided Best Buy and AT&T text files.
   - Links are used to fetch HTML content from the respective websites.

2. **Data Transformation**:
   - The downloaded HTML files are converted into XHTML format to facilitate parsing by a Python script.

3. **Data Parsing and Storage**:
   - A Python script parses the XHTML files, extracting relevant information about prices and product details.
   - Extracted data is transferred to MySQL tables for organized storage.

4. **Web Presentation**:
   - PHP is utilized to access the MySQL tables and retrieve the relevant information.
   - The information is dynamically displayed to the user through HTML and styled using CSS.

## Technologies Used

- **Bash**: For automated data collection from Best Buy and AT&T.
- **Python**: For parsing HTML and extracting essential information.
- **MySQL**: To store and manage the extracted data.
- **PHP**: To interact with the MySQL database and retrieve information for presentation.
- **HTML/CSS**: To create a user-friendly and visually appealing interface.


