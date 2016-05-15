Minimizing business impact in case of server/network outage
==============

*Team "THE GREAT GATSBY"*
--------------
- Raj Vimal Chopra
- Animesh Singh
- Arunkrishnan P


Table of Contents
--------------
1. The Big Picture
2. Solution Approach
3. Advantages
4. Assumptions
5. Future State
6. Exposed API's
7. Tech Stack


1. *The Big picture* 
--------------
There are many crucial factors that determine the success of any business.  However, having reliable system is a key factor and downtime can seriously impede business success depending on the frequency and duration.
Downtime = no new orders = loss in business =  BAD
Downtime happens on the rarest of the occasions but when it does due to some reason or the other, it completely halts the business and companies loose money as well as potential customers every second.
*Some recent examples:*
- Swiggy servers were down for half a day in November'2015 due an issue with the Airtel's network which in turn lead to a huge loss in revenue and manpower as swiggy drivers were left without work.
- Last week AWS Singapore service went down due to a faulty fiber optic cable and a lot of small scale startups had to buy new instances and reroute their entire infrastructure just to maintain operability.

Apart from that, logistics and delivery companies face a lot of issues when migrating to the TIER II and TIER III cities due to improper network infrastructure. 
With that in mind we tried to implement a decentralized solution for Opinio which would make sure the business is not impacted during the server downtime  and seamless service is delivered throughout India.

2. *Solution Approach*
--------------
Creating a decentralized contingency plan during server/network outage by shadowing the dependency on master server using hyper local server which takes over the control.
We are using a decentralized system adds one extra component to the whole client server equation. This component acts as a sleeper server and silently watches the entire network on a local scale ( citywide )  and maintains a temporary state of all the active resources and deliveries.
For simplicity sake we will call the following as:
Cloud Service : **Oblivion instance**
Sleeper Server : **MegaMind**
Field Pilots : **Minions**
Business Clients : **Merchants**

The Minions try to connect to the Oblivion via HTTP and if that request fails for more than 30 seconds it sends a HTTP request to the MegaMind server and if that fails as well due to a connectivity issue, it sends a SMS request.
As soon as the MegaMind gets the request from the Minion it tries to route the request to the server in case the Minion was not able to reach the server directly.  If the request to the service fails, Megamind becomes as the acting Server and provides next set of instructions to the Minion while maintaing a queue of events.
 The order requests sent by Merchants are also routed to the MegaMind start sending the requests and pooling up in the MegaMind server. Megamind takes the appropriate action while queueing the events.
As soon as the Oblivion instance comes back online and is stable (for consecutive requests), MegaMind updates the cloud instance with its queue and goes back to silent mode.


3. *Advantages*
--------------
- When the Cloud service goes down, the *MegaMind* fires up and acts as a server to its local nodes ( citywide ). 
- MegaMind ensures that the logistics information reaches the field pilots as their delivery system is not impacted.
- It also takes in new requests from the merchant and forwards the same to the field pilots.
- Is able to communicate at the GSM frequency by transmitting SMS with delivery and geo information required.
- Stores all the events in a queue and updates the master server as soon as it comes online.
- Reliable model to venture into the TIER II and TIER III cities.

4. *Assumptions*
--------------
- Megamind has 100% uptime.
- Groud pilot Apps are able to send SMS and GSM service has 100% uptime.
- MegaMind could be as small as GSM shield with Arduino and as big as required based on the city under scope.

5. *Future State*
--------------
- Scalable to support the business in case of any major catastrophic event for upto a few days.
- MegaMind runs the same algorithm as the main server, enabling smooth business flow and maintaining the standards of customer satisfaction.
- Can be launched in TIER II and TIER III cities to act as the central server for routing hyperlocal deliveries.


6. *Exposed API's*
--------------

**Obvilion EndPoints**
	/score
	/updatemaster/ind/generalinfo
	/updatemaster/ind/deliveryInfo
	/updatemaster/bulk/generalinfo
	/updatemaster/bulk/deliveryInfo
	/placeOrder
	/trackOrder
	/cancelOrderll
	/updateOrder


**Minion EndPoints**
	/assign
	/getdeliveryinfo
	/getgeneralinfo


**Merchant EndPoints**
	/pushdeliveryinfo
	/pushgeneralinfo


**MegaMind EndPoints**
	/ind/assigntominion
	/bulk/assigntominions
	/ind/getminiongeneralinfo
	/ind/getminiondeliveryinfo
	/bulk/getminionsgeneralinfo
	/bulk/getminionsdeliveryinfo
	/ind/setminiongeneralinfo
	/bulk/setminionsgeneralinfo
	/score
	/placeOrder
	/trackOrder
	/updateOrder
	/cancelOrder
 

7. *Tech Stack*
--------------

	> PHP
	> MYSQL
	> Beanstalkd
	> Squid proxy
	> Cron Jobs
