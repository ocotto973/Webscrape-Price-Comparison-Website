import mysql.connector
import sys
import xml.dom.minidom

if sys.argv[2] == "1":
	doc = xml.dom.minidom.parse(sys.argv[1])
	span_elements = doc.getElementsByTagName('span')
	#get price
	span_elements = [element for element in span_elements if 'true' in element.getAttribute('aria-hidden').split()]
	for span in span_elements:
		price = span.firstChild.nodeValue
		if price != None and price[0] == '$':
			price = span.firstChild.nodeValue[1:]
			break
	price = float(price)
	price = "{:.2f}".format(price)
	#print(price)
	#get description
	allDivs = doc.getElementsByTagName('div')
	for div in allDivs:
		if div.hasAttribute('class'):
			if div.getAttribute('class') == 'description-text clamp lv':
				p = div.getElementsByTagName('p')
				if p:
					description = p[0].firstChild.nodeValue
	#print(description)
	#get review
	allP = doc.getElementsByTagName('p')
	for p in allP:
		if p.hasAttribute('class'):
			if p.getAttribute('class') == 'sr-only':
				ograting = p.firstChild.nodeValue
				rating = ograting[7:10]
				break
	try:
		rating = float(rating)
		rating = "{:.1f}".format(rating)
	except ValueError as e:
		rating = ograting[7]
		rating = float(rating)
		rating = "{:.1f}".format(rating)
	#print(rating)
	#get name
	allH = doc.getElementsByTagName('h1')
	for h in allH:
		if h.hasAttribute('class'):
			if h.getAttribute('class') == 'heading-5 v-fw-regular':
				name = h.firstChild.nodeValue
	#print(name)
	#get image URL
	allMeta = doc.getElementsByTagName('meta')
	for meta in allMeta:
		if meta.hasAttribute('property'):
			if meta.getAttribute('property') == 'og:image':
				imageURL = meta.getAttribute('content')
	#print(imageURL)
elif sys.argv[2] == "2":
	#for ATT
	#get price
	doc = xml.dom.minidom.parse(sys.argv[1])
	allSpan = doc.getElementsByTagName('span')
	for span in allSpan:
		if span.hasAttribute('class') and span.getAttribute('class') == 'type-34 line-h-xs':
			price = span.firstChild.nodeValue
			break
	price = float(price)
	price = "{:.2f}".format(price)
	#print(price)
	#get description
	for span in allSpan:
		if span.hasAttribute('class') and span.getAttribute('class') == 'type-sm rte-styles':
			try:
				description = span.firstChild.nodeValue
				break
			except AttributeError as e:
				allP = doc.getElementsByTagName('p')
				description = allP[0].firstChild.nodeValue
	#print(description)
	#get rating
	rating = -1.0
	for span in allSpan:
		if span.hasAttribute('class') and span.getAttribute('class') == 'jsx-1633894462 span-a font-bold':
			rating = span.firstChild.nodeValue
			break
	rating = float(rating)
	rating = "{:.1f}".format(rating)
	#print(rating)
	#get name
	allH2 = doc.getElementsByTagName('h2')
	for h2 in allH2:
		if h2.hasAttribute('class') and h2.getAttribute('class') == 'mar-b-none heading-md color-ui-black':
			name = h2.firstChild.nodeValue
			break
	#print(name)
	allIMG = doc.getElementsByTagName('img')
	for img in allIMG:
		if img.hasAttribute('class') and img.getAttribute('class') == 'centered cursor':
			imageURL = "https://www.att.com"
			imageURL+=img.getAttribute('src')
	#print(imageURL)

def insert(cursor,name,description,price,imageURL,rating):
	query = 'INSERT INTO dropshipTable(productName,description,price,imageURL,reviewScore) VALUES (%s,%s,%s,%s,%s)'
	cursor.execute(query, (name,description,price,imageURL,rating))


def update(cursor,name,description,price,imageURL,rating):
	query = 'UPDATE dropshipTable SET description=%s,price=%s,imageURL=%s,reviewScore=%s WHERE productName=%s'
	cursor.execute(query, (description,price,imageURL,rating,name))

try:
	cnx = mysql.connector.connect(host='localhost',user='oscarcotto',password="abc",database='tryBase')
	cursor = cnx.cursor()
	if sys.argv[3] == "1":
		insert(cursor,name,description,price,imageURL,rating)
		cnx.commit()
	else:
		update(cursor,name,description,price,imageURL,rating)
		cnx.commit()
	cursor.close()
except mysql.connector.Error as err:
	print(err)
finally:
	try:
		cnx
	except NameError:
		pass
	else:
		cnx.close()
