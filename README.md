# Feathr Ecommerce CMS
The Idea behind feathr is to create a simple and lightweight ecommerce cms to quickly setup a simple but completely customizable online store. It uses a flat file database for its products. It uses the [skeleton](http://getskeleton.com) CSS framework. 

#Disclaimer
This project is still under development and NOT finished therefore you might encounter bugs and missing features.

#Usage
To add new products edit the data.csv like in the following format, product images have to be provided in the images folder.
  Code|Product|Price|Currency|ImagePath|Description|Variants

- Code is the product code it is used to refer to a product when opening the product page or checking out.
- Product is the Product Name.
- Use ImagePath to assign a product image.
- Add Variants if you want to add different variants to a product, for example different sizes.

If you want to change how the products are ordered on the page just changes in which line the product is defined. The first (second line) product in data.csv is the first product on the page.

#License
Feel free to use and hack feathr it is licensed under the [MIT license](https://en.wikipedia.org/wiki/MIT_License).
