import requests

URL = "http://localhost:8080/food-trucks"

params = {'longitude': 37,
		'latitude': -122,
		'limit': 3}

r = requests.get(url = URL, params = params)

bodyResponse = r.json()

for foodTruck in bodyResponse :
	print("Name : " + foodTruck['applicant'] + "\r\n\t" +
			"Latitude : " + foodTruck['latitude'] + "\r\n\t" + 
			"Longitude : " + foodTruck['longitude'] + "\r\n")