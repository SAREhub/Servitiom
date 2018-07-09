## Service Instance Deploy Template

Deploying service instance can consist of many steps,
with ServiceInstanceDeployTemplate you can describe that steps.

#### Schema

```yaml
apiVersion: v1
deploySteps:
    <unique_step_id>:
        type: <type of step like ApiCall>
        parameters:
            <step type depends>
```

##### Example

```yaml
apiVersion: v1
deploySteps:
  RegisterInApi:
    type: ApiCall
    parameters:
      method: PUT
      uri: {{serviceInfo.subservices.api.baseUri}}/service/accounts/{{instanceInfo.customs.accountId}}
  DeployModule:
    type: DockerServiceCreate
    parameters:
      name: {{serviceInfo.name}}_{{instanceInfo.customs.accountId}}
      image: {{serviceInfo.subservices.api.image}}
      env:
        - HUBID={{instanceInfo.customs.accountId}}
```