#######
Tenants
#######

Tenant in Servitiom represents client organization, who using subset of registered services. Tenant simply compose services for unique business purpose.
Service instance can be attached to only one tenant and when tenant is removed with all attached resources.

===============
Adding a Tenant 
===============

--------
REST API
--------

Overview

+-------------------------+-----------------+
| Resource path           |  /tenants       |  
+-------------------------+-----------------+
| HTTP Method             |  POST           |  
+-------------------------+-----------------+
| Request/Response Format |application/json |
+-------------------------+-----------------+

Sample request

.. code-block:: json

    {
        "id": "1",
        "name": "Big Oil Company",
        "customProperties": {
            "clientClass": "A+"
        }
    }


=================
Removing a Tenant 
=================

--------
REST API
--------

Overview

+-------------------------+----------------------+
| Resource path           |  /tenants/{tenantId} |  
+-------------------------+----------------------+
| HTTP Method             |  DELETE              |   
+-------------------------+----------------------+
| Request/Response Format |application/json      |
+-------------------------+----------------------+

==================
Upadating a Tenant
==================

--------
REST API
--------

Overview

+-------------------------+----------------------+
| Resource path           |  /tenants/{tenantId} |  
+-------------------------+----------------------+
| HTTP Method             |  PATCH                |   
+-------------------------+----------------------+
| Request/Response Format |application/json      |
+-------------------------+----------------------+

Sample request

.. code-block:: json

    {
        "name": "Big Oil Company",
        "customProperties": {
            "clientClass": "A+"
        }
    }


=============================
Getting details about Tenants 
=============================

--------
REST API
--------

Overview

+-------------------------+----------------------+
| Resource path           |  /tenants            |  
+-------------------------+----------------------+
| HTTP Method             |  GET                 |   
+-------------------------+----------------------+
| Request/Response Format |application/json      |
+-------------------------+----------------------+

============================
Getting details about Tenant
============================

--------
REST API
--------

Overview

+-------------------------+----------------------+
| Resource path           |  /tenants/{tenantId} |  
+-------------------------+----------------------+
| HTTP Method             |  GET                 |   
+-------------------------+----------------------+
| Request/Response Format |application/json      |
+-------------------------+----------------------+
