################################
Service Instance Deploy Template
################################

Deploying service instance can consist of many steps,
with simple template you can describe what must be done to run instance of your service.

======
Schema
======

.. code-block:: yaml

 apiVersion: v1
  serviceVersion: # version of service
  steps:
    upgrade: # represents list of steps to upgrade from specify version of service
      from:
        <version>:
          steps:
            <step id>: # unique id of step
             name: # human friendly name of step
             description: # some text to describe step operations
             type: # type of step must be one of supported step types like ApiCall
             parameters:
               # some step depends parameters
    deploy: # represnts list of steps to deploy new service instance
      <step id>: # unique id of step
       name: # human friendly name of step
       description: # some text to describe step operations
       type: # type of step must be one of supported step types like ApiCall
       parameters:
         # some step depends parameters
    remove:  # represnts list of steps to remove service instance
    <step id>: # unique id of step
     name: # human friendly name of step
     description: # some text to describe step operations
     type: # type of step must be one of supported step types like ApiCall
     parameters:
       # some step depends parameters
-------
Example
-------

.. code-block:: yaml

 apiVersion: v1
  deploySteps:
   RegisterInApi:
    type: ApiCall
    parameters:
     method: PUT
     uri: "{{serviceInfo.subservices.api.baseUri}}/service/accounts/{{instanceInfo.customs.accountId}}"
   DeployModule:
    type: DockerServiceCreate
    parameters:
     name: "{{serviceInfo.name}}_{{instanceInfo.customs.accountId}}"
     image: "{{serviceInfo.subservices.module.image}}"
     env:
       - ACCOUNTID="{{instanceInfo.customs.accountId}}"
