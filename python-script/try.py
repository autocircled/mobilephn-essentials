from urllib.request import urlopen, Request
from bs4 import BeautifulSoup as soup
from pathlib import Path
# import dateutil.parser
from datetime import datetime, timedelta
import io
import os
import sys
import numpy as np
import ssl

def check_my_ip():
	proxy = "http://9zngMBKFJQQ2Rg8V:k6JurP73ejm23UwEK9SM4kH@171.22.133.55:7314/"
	if proxy != None:
		script_host = 'Proxy Server IP: '
		os.environ['http_proxy'] = proxy 
		os.environ['HTTP_PROXY'] = proxy
		os.environ['https_proxy'] = proxy
		os.environ['HTTPS_PROXY'] = proxy
	else:
		script_host = 'Local PC IP: '

	# print current IP
	external_ip = urlopen('https://ipv4.webshare.io/').read().decode('utf8')
	print(script_host + external_ip)

def main( args ):
	check_my_ip()
	now =  datetime.now() + timedelta(hours= -6)
	ft = now.strftime('%A, %d %b %Y %H:%M:%S')
	st = now.strftime("%Y-%m-%d %H:%M:%S")
	rt = now.strftime('%Y%m%d-%H%M%S')
	
	# This restores the same behavior as before.
	context = ssl._create_unverified_context()
	# open connection and grabbing the page
	url = input("Paste link here\r")
	request = Request(url)
	request.add_header('User-agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/111.0')
	with urlopen(request, context=context) as uClient:
		page_html = uClient.read()
		uClient.close()
	
	# html parsing
	page_soup = soup(page_html, "html.parser")
	item_container = page_soup.find('div', attrs = {'class':'main'})
	title_arr = item_container.h1.text.split()
	title_filter = np.array(title_arr)
	sep = ' '
	title = sep.join(title_filter[1:])

	# Brand Name
	brand = title_filter[0]

	# Item Specifications
	specifications_container = page_soup.find('div', attrs = {'id':'specs-list'})

	# Excerpt + description
	if brand == 'Apple':
		excerpt = 'Specifications of ' + brand + ' ' + title + '.'
		description = '<p>Specifications of ' + brand + ' ' + title + '.'
	else:
		excerpt = brand + ' ' + title + ' Android smartphone specifications.'
		description = '<p>' + brand + ' ' + title + ' Android smartphone specifications.'



	tables = specifications_container.find_all("table")
	table_contents = {}
	VALUES_ARRAY = []
	thead = {}
	filename = Path("raw-data.xml")
	with io.open(filename, "a+", encoding="utf-8") as f:
		f.write("<item>\r")
		f.write("\t<title>%s %s</title>\r" % (brand, title))
		f.write("\t<pubDate>%s</pubDate>\r" % (ft))
		f.write("\t<wp:post_date><![CDATA[%s]]></wp:post_date>\r" % (st))
		f.write("\t<wp:status><![CDATA[publish]]></wp:status>\r")
		f.write("\t<wp:post_type><![CDATA[phone]]></wp:post_type>\r")
		f.write("\t<wp:post_name><![CDATA[%s %s - %s]]></wp:post_name>\r" % (brand, title, rt))
		f.write("\t<category domain=\"brand\" nicename=\"%s\"><![CDATA[%s]]></category>\r" % (brand, brand))
		f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[brand]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s]]></wp:meta_value>\r\t</wp:postmeta>\r" % (brand))
		f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[brand_alt]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s %s review and specifications]]></wp:meta_value>\r\t</wp:postmeta>\r" % (brand, title))


		count = 0
		for table in tables:
			thead[tables.index(table)] = table.tr.th.getText().strip()
			rows = table.find_all("tr")
			ij = ik = 0
			for tr in rows:
				row_cells = [ td.getText().strip() for td in tr.find_all('td') if td.getText().strip() != '' ]
				
				# main_camera, selfie_camera
				column_title = thead[count].replace(' ', '_').lower()
				# print(column_title + ': ' +str(row_cells))
				if column_title == 'battery' and len(row_cells) == 1:
					f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[battery_type]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s]]></wp:meta_value>\r\t</wp:postmeta>\r" % (row_cells[0]))
					excerpt += ' It is powered by ' + row_cells[0]
				
				if len(row_cells) > 1:
					string = thead[count] + '_' + row_cells[0]
					key = string.replace(' ', '_').replace('.','').lower()
					value = row_cells[1]

					# checking camera
					# single, dual, triple, quad, five
					camera_type = row_cells[0].lower()

					if column_title == 'main_camera':
						if camera_type != "features" and camera_type != "video":
							f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[main_camera_type]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s]]></wp:meta_value>\r\t</wp:postmeta>\r" % (camera_type))
							f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[main_camera_info]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s]]></wp:meta_value>\r\t</wp:postmeta>\r" % (value))
						else:
							f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[%s]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s]]></wp:meta_value>\r\t</wp:postmeta>\r" % (key, value))
						# print(camera_type)
						# camera type true

					elif column_title == 'selfie_camera' :

						# print(numbers_to_strings(camera_type))
						# print(column_title)
						if camera_type != "features" and camera_type != "video":
							f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[selfie_camera_type]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s]]></wp:meta_value>\r\t</wp:postmeta>\r" % (camera_type))
							f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[selfie_camera_info]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s]]></wp:meta_value>\r\t</wp:postmeta>\r" % (value))
						else:
							f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[%s]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s]]></wp:meta_value>\r\t</wp:postmeta>\r" % (key, value))
					else:
						if column_title == 'tests' :
							pass
						else :
							f.write("\t<wp:postmeta>\r\t\t<wp:meta_key><![CDATA[%s]]></wp:meta_key>\r\t\t<wp:meta_value><![CDATA[%s]]></wp:meta_value>\r\t</wp:postmeta>\r" % (key, value))
					
					# added excerpt + description data
					if column_title == 'launch' and row_cells[0] == 'Announced':
						excerpt += ' ' + row_cells[0] + ' ' + row_cells[1] + '.'
						description += ' ' + row_cells[0] + ' ' + row_cells[1] + '.'
						
					if column_title == 'body' and row_cells[0] == 'Build':
						excerpt += ' ' + thead[count] + ' ' + row_cells[0] + ' with ' + row_cells[1] + '.'
						description += ' ' + thead[count] + ' ' + row_cells[0] + ' with ' + row_cells[1] + '.'
						
					if column_title == 'display' and row_cells[0] == 'Type':
						excerpt += ' ' + thead[count] + ' ' + row_cells[0] + ' ' + row_cells[1]
						description += ' ' + thead[count] + ' ' + row_cells[0] + ' ' + row_cells[1]
						
					if column_title == 'display' and row_cells[0] == 'Size':
						excerpt += ' and which ' + thead[count] + ' ' + row_cells[0] + ' ' + row_cells[1] + '.'
						description += ' and which ' + thead[count] + ' ' + row_cells[0] + ' ' + row_cells[1] + '.'
						
					if column_title == 'platform' and row_cells[0] == 'OS':
						description += ' ' + thead[count] + ' ' + row_cells[0] + ' is ' + row_cells[1]
						
					if column_title == 'platform' and row_cells[0] == 'Chipset':
						description += ' and ' + row_cells[0] + ' is ' + row_cells[1] + '.</p>'
						
					if column_title == 'memory' and row_cells[0] == 'Card slot':
						if row_cells[1] == 'No':
							description += '<p>There is no extra card slot but'
						else:
							description += '<p>There is a ' + row_cells[0] + ' ' + row_cells[1] + ' and'
							
					if column_title == 'memory' and row_cells[0] == 'Internal':
							description += ' ' + row_cells[0] + ' memory is ' + row_cells[1] + '.</p>'
					
					if column_title == 'main_camera':
						if ij == 0:
							description += '<p>This awesome phone has <strong>' + row_cells[0] + ' rear camera</strong>'
							ij = ij + 1
					
					if column_title == 'selfie_camera':
						if ik == 0:
							description += ' and <strong>' + row_cells[0] + ' front camera</strong>.</p>'
							ik = ik + 1
						
							
					if column_title == 'sound' and row_cells[0] == '3.5mm jack':
						if row_cells[1] == 'No':
							description += '<p>This phone has no 3.5mm jack port.</p>'
						else:
							description += '<p>This phone also has a 3.5mm jack port.</p>'
			count = count + 1
		
		f.write("\t<content:encoded><![CDATA[%s]]></content:encoded>\r" % (description))
		f.write("\t<excerpt:encoded><![CDATA[%s]]></excerpt:encoded>\r" % (excerpt))
		f.write("</item>\r")
		f.close()
	# print(description)
	print(brand + ' ' +title + " successfully added!!!\r")

if __name__ == "__main__":

    #calling the main function
    main(sys.argv)