#########
Servitiom
#########

**Servitiom** makes managing of microservices instances simpler.

==========
Background
==========

In Hybrid Tenancy environments same microservice can be deployed multiple times
with different parameters(like memory limit, replicas) for single customer or group of customers
additionally, deployment can consist of many unique steps and each of them may need to change some parameters.

What is needed is an appropriate tool that will ensure ease of deployment and scaling single service instance.
**Servitiom** is just such a tool,
thanks to template system you can describe steps of service instance deployment
with some custom parameters.

========
Features
========

  * Powerful template system to describe many aspects of service deployment, upgrading and removing.
  * Bulit-in deployment step strategies:

    * Docker Swarm Service
    * REST API calling
    * Remote ssh command calling
    * Email sending (for steps that require some manual work)
    
  * Service deployment versioning and upgrading based on templates.
  * REST API

========
Contents
========

.. toctree::
   :maxdepth: 2
   :name: mastertoc

   services
   tenants
   variables