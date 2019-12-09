import requests
import getopt
import sys

### Define const ###
URL = "http://localhost:8080/food-trucks"
WARNING = '\033[31m'
RESETALL = '\033[0m'
BOLD = '\033[1m'

### Functions ###
def usage() :
	print("Food trucks finder CLI\r\n" + 
			"Available options : \r\n"+ 
			"\t--help\t\t\tDisplays this help\r\n" + 
			"\t--latitude <float>\tSet the latitude of the research (required)\r\n" + 
			"\t--longitude <float>\tSet the longitude of the research (required)\r\n" + 
			"\t--limit <int>\t\tSet the limit (number of values displayed) of the research (optional)\r\n")

def error(message) :
	print(WARNING + BOLD + message + RESETALL)

### Default values ###
limit = 5


options, remainder = getopt.getopt(sys.argv[1:], '', ['latitude=', 'longitude=', 'limit=', 'help'])

if not options:
	error("You must use --latitude and --longitude")
	usage()
	sys.exit(2)

if remainder :
	error("Unknow option : " + remainder[0])
	usage()
	sys.exit(2)

for option, argument in options :
	if option in ('--latitude'):
		latitude = float(argument)
	if option in ('--longitude') :
		longitude = float(argument)
	if option in ('--limit') :
		limit = int(argument)
	if option in ('--help'):
		usage()
		sys.exit(2)

if 'latitude' not in locals() or 'longitude' not in locals() :
	error("You must use --latitude and --longitude")
	usage()
	sys.exit(2)

params = {'longitude': longitude,
		'latitude': latitude,
		'limit': limit}
r = requests.get(url = URL, params = params)
bodyResponse = r.json()

for foodTruck in bodyResponse :
	print("Name : " + foodTruck['applicant'] + "\r\n\t" +
			"Menu : " + foodTruck['fooditems'] + "\r\n\t" + 
			"Address : " + foodTruck['address'] + "\r\n\t" + 
			"Latitude : " + foodTruck['latitude'] + "\r\n\t" + 
			"Longitude : " + foodTruck['longitude'] + "\r\n")
