import Common from './common'

export default class ExampleClass extends Common {
  constructor () {
    super()
    this.message = 'Hello World'
  }

  helloWorld () {
    console.log(this.message)
  }
}
